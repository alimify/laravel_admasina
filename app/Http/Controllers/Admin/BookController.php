<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Book;
use App\Category;
use App\DataLink;
use App\Description;
use App\Language;
use App\Laraption;
use App\Tag;
use App\Title;
use App\Translator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(Config::get('websettings.adminItemPerPage'));

        return view('admin.book.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all()->where('category_for','book');
        $tags = Tag::all();
        $translators = Translator::all();
        $languages = Language::all()->where('is_active',true);
        $langData = [];
        $langEbook = [];
        $langIdList = [];
        foreach ($languages as $language){
            $langData[$language->id] = [
                'langId' => $language->id,
                'title' => '',
                'description' => ''
            ];

            $langEbook[$language->id] = [
                'langId' => $language->id,
                'file' => ''
            ];

            $langIdList[] = $language->id;

        }

        return view('admin.book.book.create',compact('authors','categories','tags','translators','languages','langData','langEbook','langIdList'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = json_decode($request->data);
        $requestMainData = $requestData->main;

         $createBook = false;
         $titleData = [];
         $descriptionData = [];
         $ebookLinkdata = [];

        foreach ($requestMainData as $mainData){
            if($mainData->title){
                $createBook = true;
            }

            $titleData[] = [
                'language_id' => $mainData->langId,
                'title_id' => $this->addTitle($mainData->title)
            ];

            $descriptionData[] = [
                'language_id' => $mainData->langId,
                'description_id' => $this->addDescription($mainData->description)
            ];

            $ebookFile = $request->file('ebook'.$mainData->langId);
            if(isset($ebookFile) && $ebookFile) {
                $ebookLinkdata[] = [
                    'language_id' => $mainData->langId,
                    'data_link_id' => $this->addEbookFile($ebookFile)
                ];
            }
        }



        if($createBook){

            $image = $request->file('image');
            $imageName = 'default.png';


            if(isset($image) && $image){
                $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();


                if (!Storage::disk('public')->exists('book')) {
                    Storage::disk('public')->makeDirectory('book');
                }

                $bookImage = Image::make($image)->resize(512,512)->save('temp/tmp.'.$image->getClientOriginalExtension());
                Storage::disk('public')->put('book/'.$imageName,$bookImage);

            }




       $book = new Book();
       $book->user_id = Auth::id();
       $book->is_active = $requestData->is_active;
       $book->image = $imageName;
       $book->save();
       $book->authors()->attach($requestData->author);
       $book->tags()->attach($requestData->tag);
       $book->translators()->attach($requestData->translator);
       $book->categories()->attach($requestData->category);
       $book->titles()->attach($titleData);
       $book->descriptions()->attach($descriptionData);
       $book->datalinks()->attach($ebookLinkdata);
       $bookId = $book->id;

            return response()->json([
                'status' => true,
                'bookId' => $bookId
            ]);


        }else{
            return response()->json(['status' => false]);
    }

       // return $langData;
    }



    private function addTitle($title){
    $bookTitle = new Title();
    $bookTitle->title = preg_replace('/\s+/', ' ', $title);
    $bookTitle->save();
    return $bookTitle->id;
    }

    private  function addDescription($text){
        $description = new Description();
        $description->description = $text;
        $description->save();
        return $description->id;
    }

   private function addEbookFile($file){

        if(isset($file) && $file){
            $directory = 'ebook/'.Carbon::now()->format('F-Y');

            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
            $link = Storage::disk('public')->putFile($directory,$file);
        }
        else{
            return;
        }

        $dataLink = new DataLink();
        $dataLink->link = $link;
        $dataLink->save();
        return $dataLink->id;
   }



    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.book.book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all()->where('category_for','book');
        $tags = Tag::all();
        $translators = Translator::all();
        $languages = Language::all()->where('is_active',true);


        $mainBookTitles = $book->titles;
        $mainBookDescriptions = $book->descriptions;
        $mainBookDataLinks = $book->datalinks;

        $mainBookAuthors = $book->authors;
        $mainBookTranslators = $book->translators;
        $mainBookCategories = $book->categories;
        $mainBookTags = $book->tags;

        /*Start Data Processing*/
        $bookTitleLangKey = [];
        foreach ($mainBookTitles as $singleBookTitle){
            $bookTitleLangKey[$singleBookTitle->pivot->language_id] = $singleBookTitle;
        }

        $bookDescriptionLangKey = [];
        foreach ($mainBookDescriptions as $singleBookDescription){
            $bookDescriptionLangKey[$singleBookDescription->pivot->language_id] = $singleBookDescription;
        }

        $bookDatalinkLangKey = [];
        foreach ($mainBookDataLinks as $singleDataLink){
            $bookDatalinkLangKey[$singleDataLink->pivot->language_id] = $singleDataLink;
        }


        $langData = [];
        $langEbook = [];
        $langIdList = [];
        $langAbleEbook = [];
        foreach ($languages as $language){
            $langData[$language->id] = [
                'langId' => $language->id,
                'title' => $bookTitleLangKey[$language->id]->title ?? '',
                'description' => $bookDescriptionLangKey[$language->id]->description ?? ''
            ];

            $langEbook[$language->id] = [
                'langId' => $language->id,
                'file' => '',
                'langTitle' => $language->language
            ];
            $langAbleEbook[$language->id] = [
                'langId' => $language->id,
                'link' => $bookDatalinkLangKey[$language->id]->link ?? ''
            ];

            $langIdList[] = $language->id;

        }



        $authorIdArray = [];
        foreach ($mainBookAuthors as $singleAuthorData){
            $authorIdArray[] = $singleAuthorData->id;
        }


        $translatorIdArray = [];
        foreach ($mainBookTranslators as $singleTranslatorData){
            $translatorIdArray[] = $singleTranslatorData->id;
        }

        $categoryIdArray = [];
        foreach ($mainBookCategories as $singleCategoryData){
            $categoryIdArray[] = $singleCategoryData->id;
        }

        $tagIdArray = [];
        foreach ($mainBookTags as $singleTagData){
            $tagIdArray[] = $singleTagData->id;
        }

        return view('admin.book.book.edit',compact('authors','book','languages','translators','tags',
            'categories','langData','langEbook','langIdList','langAbleEbook',
            'authorIdArray','translatorIdArray','categoryIdArray','tagIdArray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {

        $book->titles()->delete();
        $book->descriptions()->delete();

        $requestData = json_decode($request->data);
        $requestMainData = $requestData->main;


        $titleData = [];
        $descriptionData = [];
        $ebookLinkdata = [];

        foreach ($requestMainData as $mainData){

            $titleData[] = [
                'language_id' => $mainData->langId,
                'title_id' => $this->addTitle($mainData->title)
            ];

            $descriptionData[] = [
                'language_id' => $mainData->langId,
                'description_id' => $this->addDescription($mainData->description)
            ];

            $ebookFile = $request->file('ebook'.$mainData->langId);
            $yesNewFile = isset($ebookFile) && $ebookFile;
            $ebookFileId = $this->checkExistingFile($yesNewFile,$ebookFile,$book->id,$mainData->langId);
            if($ebookFileId) {
                $ebookLinkdata[] = [
                    'language_id' => $mainData->langId,
                    'data_link_id' => $ebookFileId
                ];
            }

        }



            $image = $request->file('image');
            if(isset($image) && $image){
                $imageName = uniqid().str_slug(Carbon::now()).'.'.$image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('book')) {
                    Storage::disk('public')->makeDirectory('book');
                }

                if(Storage::disk('public')->exists('book/'.$book->image)){
                    Storage::disk('public')->delete('book/'.$book->image);
                }

                $bookImage = Image::make($image)->resize(512,512)->save('temp/tmp.'.$image->getClientOriginalExtension());
                Storage::disk('public')->put('book/'.$imageName,$bookImage);

            }else{
                $imageName = $book->image;
            }




            $book->is_active = $requestData->is_active;
            $book->image = $imageName;
            $book->save();
            $book->authors()->sync($requestData->author);
            $book->tags()->sync($requestData->tag);
            $book->translators()->sync($requestData->translator);
            $book->categories()->sync($requestData->category);
            $book->titles()->sync($titleData);
            $book->descriptions()->sync($descriptionData);
            $book->datalinks()->sync($ebookLinkdata);

            return response()->json([
                'status' => true,
                'bookId' => $book->id
            ]);
    }

    public function changeStatus(Book $book){
     $book->is_active = !$book->is_active;
     $book->save();
     return redirect()->back()->with('status','Book Status Successfully Updated..');
    }


    private function checkExistingFile($newfile,$file,$bookId,$langId){

        $exist = DB::table('book_data_link')
                     ->where('book_id','=',$bookId)
                     ->where('language_id','=',$langId)
                     ->first()
        ;

        if($newfile){
            if(isset($exist->data_link_id)){
              $existingData = \App\DataLink::find($exist->data_link_id);
              if(isset($existingData->link)){
                  if(Storage::disk('public')->exists($existingData->link)){
                      Storage::disk('public')->delete($existingData->link);
                  }
                  $existingData->delete();
              }
            }

            return $this->addEbookFile($file);
        }

        return $exist ? $exist->data_link_id : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        foreach ($book->datalinks as $datalink){
            if(Storage::disk('public')->exists($datalink->link)){
                Storage::disk('public')->delete($datalink->link);
            }
        }

        if(Storage::disk('public')->exists('book/'.$book->image)){
            Storage::disk('public')->delete('book/'.$book->image);
        }

        $book->tags()->detach();
        $book->authors()->detach();
        $book->translators()->detach();
        $book->categories()->detach();

        $book->titles()->delete();
        $book->titles()->detach();
        $book->descriptions()->delete();
        $book->descriptions()->detach();
        $book->datalinks()->detach();
        $book->datalinks()->delete();
        $book->delete();

        return redirect()->route('admin.book.index')->with('status','Book Successfully deleted..');
    }


}
