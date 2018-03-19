<?php //-->
return array (
  'disable' => '1',
  'singular' => 'Profile',
  'plural' => 'Profiles',
  'name' => 'profile',
  'icon' => 'fas fa-user',
  'detail' => 'Generic user profiles designed to separate public data from sensitive data like passwords. Best used with auth tables.',
  'fields' => 
  array (
    0 => 
    array (
      'disable' => '1',
      'label' => 'Name',
      'name' => 'name',
      'field' => 
      array (
        'type' => 'text',
      ),
      'validation' => 
      array (
        0 => 
        array (
          'method' => 'required',
          'message' => 'Name is Required',
        ),
        1 => 
        array (
          'method' => 'empty',
          'message' => 'Cannot be empty',
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
    ),
    1 => 
    array (
      'disable' => '1',
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
    ),
    2 => 
    array (
      'disable' => '1',
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
    ),
    3 => 
    array (
      'disable' => '1',
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
    ),
  ),
  'relations' => 
  array (
  ),
  'suggestion' => '{{profile_name}}',
);