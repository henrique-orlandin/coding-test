<?php
/**
*
*/
class Slug{

    /***
     * Função para remover acentos de uma string
     *
     */
    function slugger($string,$slug = false) {
        $acentuados = array('á','à','ã','ä','â',
                            'é','è','ê','ë',
                            'í','ì','ï','î',
                            'ó','ò','õ','ô','ö',
                            'ú','ù','ü','û','ç',
                            'Á','À','Ã','Ä','Â',
                            'É','È','Ê','Ë',
                            'Í','Ì','Ï','Î',
                            'Ó','Ò','Õ','Ô','Ö',
                            'Ú','Ù','Ü','Û','Ç');

        $normais = array('a','a','a','a','a',
                         'e','e','e','e',
                         'i','i','i','i',
                         'o','o','o','o','o',
                         'u','u','u','u',
                         'c','a','a','a','a','a',
                         'e','e','e','e',
                         'i','i','i','i',
                         'o','o','o','o','o',
                         'u','u','u','u','c');

        $string = strtolower(str_replace($acentuados,$normais,$string));

        // Código ASCII das vogais
        $ascii['a'] = range(224,230);
        $ascii['e'] = range(232,235);
        $ascii['i'] = range(236,239);
        $ascii['o'] = array_merge(range(242,246),array(240,248));
        $ascii['u'] = range(249,252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253,255);

        foreach ($ascii as $key=>$item) {
            $acentos = '';
            foreach ($item AS $codigo) $acentos .= chr($codigo);
            $troca[$key] = '/['.$acentos.']/i';
        }

        $string = preg_replace(array_values($troca),array_keys($troca),$string);

        if ($slug) {
            $string = preg_replace('/[^a-z0-9]/i',$slug,$string);
            $string = preg_replace('/' . $slug . '{2,}/i',$slug,$string);
            $string = trim($string,$slug);
        }

        return $string;
    }
}