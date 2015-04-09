<?php

// --------------------------------------------------------------------------
// ��������� linkmap-������ �� ������� keyword=>url
// Keyword � url ����������� �����
// --------------------------------------------------------------------------
// NOTICE: �������� ������ � ������������� �����������, �� utf-8 ����������
// ���� � ����.
// --------------------------------------------------------------------------

// ���� � ������� ������

// �������� ��� keyword=>url, ���� ������ ������������� � ��� �� ��������,
// ��� � ���� ������
$source = 'source_file_name';

// �������� ����
$dest   = 'linkmap-' . $source;

// ������ �������, ��� ������� ����� ����� ������������ 200
$size   = 100;

// ��������� ������
if(0
	|| $source == '��-truba'
	|| $source == '��-vent'
) {
	$size = 200;
}

// �������� ������� keyword=>url
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
	}
	$str[] = array($arr[0], $arr[1]);
}

// ������ linkmap-�����
$n = count($str);
$size--; // ����������� ��� \t � \n
file_put_contents($dest, sprintf("%-" . $size . "s\n", $n));
foreach($str as $k=>$v) {
	file_put_contents($dest, sprintf("%-" . $size . "s\t%-" . $size . "s\n", $v[0], $v[1]), FILE_APPEND);
}

print "Done!\n";

?>