<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\Result\ResultInterface;

class GenerateQrCode {
    public function generateQr($nameFile, $text):ResultInterface{

        $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([
            PdfWriter::WRITER_OPTION_PDF => "fpdf",
        ])
        ->data($text)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(ErrorCorrectionLevel::High)
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
        ->logoPath('./symfony.png')
        ->logoResizeToWidth(50)
        ->logoPunchoutBackground(true)
        ->labelText('We do it easy')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(LabelAlignment::Center)
        ->validateResult(false)
        ->build();
        $result->saveToFile('./'.$nameFile.'.png');
        return $result;
    }
}