<?php

use Illuminate\Database\Seeder;

class WebSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('laraptions')->insert([
            'optkey' => 'webSetting',
            'optvalue' => json_encode([
                'siteTitle' => 'ADMasina',
                'homePageTitle' => 'ADMasina',
                'defaultLanguage' => 0,
                'siteArticlePerPage' => 15,
                'siteBookPerPage' => 15,
                'siteCommentPerPage' => 15,
                'adminItemPerPage' => 15,
                'siteLogo' => 'logo.png'])
        ]);
    }
}
