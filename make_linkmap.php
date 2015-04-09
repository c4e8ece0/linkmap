<?php

// --------------------------------------------------------------------------
// Генератор linkmap-файлов из таблицы keyword=>url
// Keyword и url разделяются табом
// --------------------------------------------------------------------------
// NOTICE: работает только с однобайтовыми кодировками, на utf-8 происходит
// треш и угар.
// --------------------------------------------------------------------------

// Пути и правила сборки

// Источник пар keyword=>url, файл должен располагаться в том же каталоге,
// что и этот скрипт
$source = 'source_file_name';

// Итоговый файл
$dest   = 'linkmap-' . $source;

// Размер колонки, для длинных урлов лучше использовать 200
$size   = 100;

// Особенные случаи
if(0
	|| $source == 'уу-truba'
	|| $source == 'уу-vent'
) {
	$size = 200;
}

// Загрузка таблицы keyword=>url
$str = array();
$i=0;
foreach(file($source) as $k=>$v) {
	$i++;

	if(!strlen(trim($v))) {
		continue;
	}

	$arr = array_map('trim', explode("\t", $v));
	if(count($arr) < 2) {
		print "Not enought elems on line: ".($i+1)."\n";
		continue;
	}
	$str[] = array($arr[0], $arr[1]);
}

// Сборка linkmap-файла
$n = count($str);
$size--; // компенсация для \t и \n
file_put_contents($dest, sprintf("%-" . $size . "s\n", $n));
foreach($str as $k=>$v) {
	file_put_contents($dest, sprintf("%-" . $size . "s\t%-" . $size . "s\n", $v[0], $v[1]), FILE_APPEND);
}

print "Done!\n";

?>