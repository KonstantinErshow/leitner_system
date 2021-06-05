<?php

class View {

	public function render($tpl, $pageData) {  //tpl - шаблон страницы, + pageData для отрисовки внутри шаблона
		include ROOT. $tpl;

	}
}