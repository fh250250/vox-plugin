<?php namespace Vox\Video\API;

use Illuminate\Routing\Controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\News;
use Vox\Video\Models\Settings;
use Vox\Video\Models\Vod;
use Vox\Video\Models\Demand;

class Wechat extends Controller
{
  public function callback()
  {
    $options = [
      'debug'  => false,
      'app_id' => Settings::get('app_id'),
      'secret' => Settings::get('secret'),
      'token' => Settings::get('token'),
      'aes_key' => Settings::get('aes_key')
    ];

    $app = new Application($options);
    $server = $app->server;
    $server->setMessageHandler(function ($message) {
      switch ($message->MsgType) {
        case 'event':
          return $this->handleEvent($message);
        case 'text':
          return $this->handleText($message);
        default:
          return Settings::get('default_message');
      }
    });

    return $server->serve();
  }

  private function handleEvent($message)
  {
    if ($message->Event == 'subscribe') {
      return Settings::get('subscribe_message');
    } else {
      return null;
    }
  }

  private function handleText($message)
  {
    $content = trim($message->Content);

    if (strlen($content) < 2 || strlen($content) > 100) {
      // 太短或太长
      return Settings::get('default_message');
    }

    $vods = Vod::where('title', 'like', '%' . $content . '%')
                ->with('poster')
                ->orderBy('view_count', 'desc')
                ->limit(8)
                ->get();

    if (!count($vods)) {
      // 未搜索到结果
      Demand::addDemand($content, '微信公众号');
      return Settings::get('default_message');
    }

    return $vods->map(function ($vod) {
      return new News([
        'title' => $vod->title,
        'description' => '',
        'url' => url('video', [$vod->id]),
        'image' => $vod->poster->getThumb(320, 240, ['mode' => 'crop'])
      ]);
    })->toArray();
  }
}
