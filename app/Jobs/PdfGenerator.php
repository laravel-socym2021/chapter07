<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Knp\Snappy\Pdf;

class PdfGenerator implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path = '';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    // handleメソッドの引数に型宣言を記述すると、サービスコンテナで定義したオブジェクトが渡されます。
    public function handle(Pdf $pdf)
    {
        // html形式でPDF出力を指定します
        $pdf->generateFromHtml(
            '<h1>Laravel</h1><p>Sample PDF Output.</p>',
            $this->path
        );
    }
}
