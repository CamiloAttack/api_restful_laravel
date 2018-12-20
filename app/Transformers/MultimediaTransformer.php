<?php

namespace App\Transformers;

use App\Multimedia;
use League\Fractal\TransformerAbstract;

class MultimediaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Multimedia $multimedia)
    {
        $ruta_archivo = "";
       
        switch ((int)$multimedia->tipo_media_id) {

            case 1:
                $ruta_archivo = "archivos_media/images/";
                break;
            case 2:

                $ruta_archivo = "https://www.youtube.com/watch?v=";
                break;            
            case 3:
                $ruta_archivo = "archivos_media/videos/";
                break;
        }
        return [
            'identificador' => (int)$multimedia->id,
            'titulo' => (string)$multimedia->nom_multimedia,
            'detalles' => (string)$multimedia->desc_multimedia,
            'categoria_media_id' => (string)$multimedia->categoria_media_id,
            'imagen' => url("$ruta_archivo{$multimedia->multimedia}"),
            'tipo_media_id' => (int)$multimedia->tipo_media_id,
            'fechaCreacion' => (string)$multimedia->created_at,
            'fechaActualizacion' => (string)$multimedia->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('multimedia.show', $multimedia->id),
                ],
                [
                    'rel' => 'multimedia.tipo_media_id',
                    'href' => route('multimedia.tipo_media.index', $multimedia->id),
                ],


            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'titulo' => 'nom_multimedia',
            'detalles' => 'desc_multimedia',
            'categoria_media_id' => 'categoria_media_id',
            'tipo_media_id' => 'tipo_media_id',
            'multimedia' => 'multimedia',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
       
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'nom_multimedia' => 'titulo',
            'desc_multimedia' => 'detalles',
            'categoria_media_id' => 'categoria_media_id',
            'tipo_media_id' => 'tipo_media_id',
            'multimedia' => 'multimedia',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_at' => 'fechaEliminacion',


           ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
