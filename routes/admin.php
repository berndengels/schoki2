<?php
use Illuminate\Support\Facades\Auth;

Auth::routes();
Auth::routes(['register' => false]);
