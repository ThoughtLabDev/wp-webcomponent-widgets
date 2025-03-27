<?php
/**
 * Gerador de screenshot para o tema
 * 
 * Este arquivo gera uma imagem de screenshot para o tema.
 * Após executar este arquivo uma vez, você pode excluí-lo.
 */

// Configurações da imagem
$width = 1200;
$height = 900;
$background_color = [240, 240, 240]; // Cinza claro
$text_color = [51, 51, 51]; // Cinza escuro
$accent_color = [0, 123, 255]; // Azul primário

// Criar a imagem
$image = imagecreatetruecolor($width, $height);

// Definir cores
$bg_color = imagecolorallocate($image, $background_color[0], $background_color[1], $background_color[2]);
$txt_color = imagecolorallocate($image, $text_color[0], $text_color[1], $text_color[2]);
$accent = imagecolorallocate($image, $accent_color[0], $accent_color[1], $accent_color[2]);

// Preencher o fundo
imagefill($image, 0, 0, $bg_color);

// Desenhar elementos de design
// Cabeçalho
imagefilledrectangle($image, 0, 0, $width, 100, $accent);

// Barra lateral
imagefilledrectangle($image, 0, 100, 300, $height, imagecolorallocate($image, 250, 250, 250));

// Conteúdo principal - linhas simulando texto
for ($i = 0; $i < 10; $i++) {
    $y = 150 + ($i * 40);
    imagefilledrectangle($image, 350, $y, 1100, $y + 20, imagecolorallocate($image, 220, 220, 220));
}

// Adicionar texto
$font_size = 30;
$text = "Theme IA";
$font_path = __DIR__ . '/assets/fonts/arial.ttf'; // Ajuste para um caminho de fonte válido

// Se não tiver uma fonte TTF disponível, use o texto básico
if (!file_exists($font_path)) {
    imagestring($image, 5, 50, 40, $text, imagecolorallocate($image, 255, 255, 255));
} else {
    imagettftext($image, $font_size, 0, 50, 60, imagecolorallocate($image, 255, 255, 255), $font_path, $text);
}

// Adicionar texto descritivo
$description = "Um tema limpo e moderno para WordPress";
imagestring($image, 3, 350, 110, $description, $txt_color);

// Salvar a imagem
imagepng($image, __DIR__ . '/screenshot.png');
imagedestroy($image);

echo "Screenshot gerado com sucesso!"; 