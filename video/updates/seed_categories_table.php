<?php namespace Vox\Video\Updates;

use Seeder;
use Vox\Video\Models\Category;

class SeedCategoriesTable extends Seeder
{
  public function run()
  {
    $categories = ['电影', '电视剧', '综艺', '动漫'];
    foreach ($categories as $cate) {
      Category::create([ 'title' => $cate ]);
    }
  }
}
