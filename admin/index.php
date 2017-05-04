<?php

function draw_pfa_home()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/home.php'; # Load home page
	echo '</div>';
}

function draw_pfa_newpub()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/newpub.php'; # Load new publications page
	echo '</div>';
}

function draw_pfa_viewpub()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/viewpub.php'; # Load view publications page
	echo '</div>';
}

function draw_pfa_authors()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/authors.php'; # Load authors page
	echo '</div>';
}

function draw_pfa_settings()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/settings.php'; # Load settings page
	echo '</div>';
}

function draw_pfa_edit()
{
	echo '<div id="pfa_content">';
	require_once PFA_PATH.'admin/edit.php'; # Load edit page
	echo '</div>';
}