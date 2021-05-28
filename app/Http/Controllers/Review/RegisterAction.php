<?php

declare(strict_types=1);

namespace App\Http\Controllers\Review;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Events\ReviewRegistered;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class RegisterAction extends Controller
{
    /** @var RegisterReviewProviderInterface */
    private $provider;

    /** @var Dispatcher */
    private $dispatcher;

    // データベース登録とEvent発火を行なうクラスのインスタンスが渡されます
    public function __construct(
        RegisterReviewProviderInterface $provider,
        Dispatcher $dispatcher
    ) {
        $this->provider = $provider;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $created = Carbon::now()->toDateTimeString();
        // 登録処理を実行します
        $id = $this->provider->save(
            $request->get('title'),
            $request->get('content'),
            $request->get('user_id', 1),
            $created,
            $request->get('tags')
        );
        // 登録後にイベントが発火されます
        $this->dispatcher->dispatch(
            new ReviewRegistered(
                $id,
                $request->get('title'),
                $request->get('content'),
                $request->get('user_id', 1),
                $created,
                $request->get('tags')
            )
        );
        // POSTで動作するため、登録完了後HTTP Statusのみを返却します
        return new Response('', Response::HTTP_OK);
    }
}
