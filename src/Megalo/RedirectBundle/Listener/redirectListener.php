<?php

namespace Megalo\RedirectBundle\Listener;

/**
 * Redirige les utilisateurs selon la liste des redirections
 */
class redirectListener
{

  /**
   * fonction de redirection point d'entree (ecoute le kernel)
   */
  public function onKernelSolicitation()
  {
    $this->actRedirects();
  }

  /**
   * function de la redirection
   */
  private function actRedirects()
  {
    
    $adress = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    $tabRedirect = $this->getRedirects();

    if (array_key_exists($adress, $tabRedirect)) {
      header('Status: 301 Moved Permanently', false, 301);
      header('Location: ' . $tabRedirect[$adress]);
      exit;
    }

  }

  /**
   * Tableaux des sources
   * @return array Tableau des redirections
   */
  private function getRedirects()
  {
    $tabRedirect = array();

    $tabRedirect['http://localhost:8888/acme/web/app_dev.php/demo/hello/World'] = "http://www.google.fr";
    $tabRedirect['http://localhost:8888/acme/web/app_dev.php/demo/secured/login'] = "http://www.yahoo.fr";

    return $tabRedirect;
  }

}
