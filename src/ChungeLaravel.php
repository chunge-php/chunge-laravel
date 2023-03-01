<?php

namespace Chunge\Laravel;

class ChungeLaravel
{
  public function version()
  {
    echo '1.0.5' . "\n";
  }
  /**
   * 初始化框架
   */
  public static function postInstall()
  {
    echo '执行初始化' . "\n";
  }
}
