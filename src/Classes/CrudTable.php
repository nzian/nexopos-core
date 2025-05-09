<?php

namespace Ns\Classes;

class CrudTable
{
    /**
     * This defines the shape of a crud table
     * @param array $args
     * @return array
     */
    public static function columns( ...$args )
    {
        return collect( $args )->mapWithKeys( function ( $column ) {
            return [
                $column[ 'identifier' ] => $column,
            ];
        } )->toArray();
    }

    /**
     * This define the shape of a column
     * @param string $label
     * @param string $identifier
     * @param bool $sort
     * @param array $attributes
     * @param mixed $width
     * @param mixed $minWidth
     * @param mixed $maxWidth
     * @param string $direction
     * @return array
     */
    public static function column( string $label, string $identifier, bool $sort = true, array $attributes = [], mixed $width = 'auto', mixed $minWidth = 'auto', mixed $maxWidth = 'auto', string $direction = '' ): array
    {
        return compact( 'identifier', 'label', 'sort', 'attributes', 'width', 'direction', 'maxWidth', 'minWidth' );
    }

    /**
     * This defines a shape of a column attribute
     * @param string $label
     * @param mixed $column
     * @return array
     */
    public static function attribute( string $label, mixed $column ): array
    {
        return compact( 'label', 'column' );
    }

    /**
     * This is a wrapper for crud column attributes.
     * @param array $attributes
     * @return array
     */
    public static function attributes( ...$attributes ): array
    {
        return $attributes;
    }

    /**
     * This definesthe crud labels.
     * @param string $list_title
     * @param string $list_description
     * @param string $no_entry
     * @param string $create_new
     * @param string $create_title
     * @param string $create_description
     * @param string $edit_title
     * @param string $edit_description
     * @param string $back_to_list
     * @return array
     */
    public static function labels( string $list_title, string $list_description, string $no_entry, string $create_new, string $create_title, string $create_description, string $edit_title, string $edit_description, string $back_to_list ): array
    {
        return compact( 'list_title', 'list_description', 'no_entry', 'create_new', 'create_title', 'create_description', 'edit_title', 'edit_description', 'back_to_list' );
    }

    /**
     * This define the structure of the links
     * @param string $list
     * @param string $create
     * @param string $edit
     * @param string $post
     * @param string $put
     * @return array
     */
    public static function links( string $list, string $create, string $edit, string $post, string $put ): array
    {
        return compact( 'list', 'create', 'edit', 'post', 'put' );
    }
}
