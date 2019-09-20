<?php

get_header();

	$context = [];

	$context = Timber::get_context();
	$context["post"] = new TimberPost();

	Timber::render("page.html.twig", $context);

get_footer();