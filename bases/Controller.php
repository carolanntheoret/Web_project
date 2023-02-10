<?php

abstract class Controller
{
    public function __construct()
    {
    }
    
    /**
     * Affiche "Erreur 404" si l'utilisateur prend une route inexistante
     *
     * @return void
     */
    public function erreur404()
    {
        echo "Erreur 404";
    }

    /**
     * Redirige vers la route appelée
     *
     * @param string $url - nom de la route appelée
     * @return void
     */
    public function rediriger(string $url)
    {
        header("location:$url");
        exit();
    }
}
