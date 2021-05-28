<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\PdfGenerator;
use Illuminate\Contracts\Bus\Dispatcher;

use function dispatch;

final class PdfGeneratorAction extends Controller
{
    private $dispatcher;

    public function __construct(
        Dispatcher $dispatcher
    ) {
        $this->dispatcher = $dispatcher;
    }

    public function __invoke(): void
    {
        $generator = new PdfGenerator(storage_path('pdf/sample.pdf'));
        // コンストラクタインジェクションを利用して
        //　Illuminate\Contracts\Bus\Dispatcherインターフェースの
        // dispatchメソッドで実行指示
        // Busファサードを使って記述することもできます。
        $this->dispatcher->dispatch($generator);
        // Illuminate\Foundation\Bus\DispatchesJobsトレイト経由で
        // dispatchを利用できます
        $this->dispatch($generator);
        // dispatchヘルパ関数で実行指示
        dispatch($generator);
    }
}
