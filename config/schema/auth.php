<?php //-->
return array (
  'singular' => 'Authentication',
  'plural' => 'Authentications',
  'name' => 'auth',
  'group' => 'Users',
  'icon' => 'fas fa-lock',
  'detail' => 'Collection of verified users.',
  'fields' => 
  array (
    0 => 
    array (
      'label' => 'Email',
      'name' => 'slug',
      'field' => 
      array (
        'type' => 'text',
        'attributes' => 
        array (
          'placeholder' => 'Enter email',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Email is Required',
        ),
        1 => 
        array (
          'method' => 'regexp',
          'parameters' => '/^(?:(?:(?:[^@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff\\.]|\\x5c(?=[@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff]))(?:[^@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff\\.]|(?<=\\x5c)[@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff]|\\x5c(?=[@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff])|\\.(?=[^\\.])){1,62}(?:[^@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff\\.]|(?<=\\x5c)[@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff])|[^@,"\\[\\]\\x5c\\x00-\\x20\\x7f-\\xff\\.]{1,2})|"(?:[^"]|(?<=\\x5c)"){1,62}")@(?:(?!.{64})(?:[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\\.?|[a-zA-Z0-9]\\.?)+\\.(?:xn--[a-zA-Z0-9]+|[a-zA-Z]{2,6})|\\[(?:[0-1]?\\d?\\d|2[0-4]\\d|25[0-5])(?:\\.(?:[0-1]?\\d?\\d|2[0-4]\\d|25[0-5])){3}\\])$/',
          'message' => 'Must be a valid email',
        ),
        2 => 
        array (
          'method' => 'unique',
          'message' => 'Email is already taken',
        ),
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '',
      'searchable' => '1',
      'filterable' => '1',
      'disable' => '1',
    ),
    1 => 
    array (
      'label' => 'Password',
      'name' => 'password',
      'field' => 
      array (
        'type' => 'password',
        'attributes' => 
        array (
          'placeholder' => 'Enter a password',
        ),
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Password is Required',
        ),
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    2 => 
    array (
      'label' => 'Type',
      'name' => 'type',
      'field' => 
      array (
        'type' => 'text',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => '',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    3 => 
    array (
      'label' => 'Active',
      'name' => 'active',
      'field' => 
      array (
        'type' => 'active',
      ),
      'list' => 
      array (
        'format' => 'hide',
      ),
      'detail' => 
      array (
        'format' => 'hide',
      ),
      'default' => '1',
      'filterable' => '1',
      'sortable' => '1',
      'disable' => '1',
    ),
    4 => 
    array (
      'label' => 'Created',
      'name' => 'created',
      'field' => 
      array (
        'type' => 'created',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
    5 => 
    array (
      'label' => 'Updated',
      'name' => 'updated',
      'field' => 
      array (
        'type' => 'updated',
      ),
      'list' => 
      array (
        'format' => 'none',
      ),
      'detail' => 
      array (
        'format' => 'none',
      ),
      'default' => 'NOW()',
      'sortable' => '1',
      'disable' => '1',
    ),
  ),
  'relations' => 
  array (
    0 => 
    array (
      'many' => '1',
      'name' => 'profile',
    ),
  ),
  'suggestion' => '{{auth_slug}}',
  'disable' => '1',
);