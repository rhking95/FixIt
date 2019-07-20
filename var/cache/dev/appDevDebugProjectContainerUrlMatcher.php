<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($rawPathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $trimmedPathinfo = rtrim($pathinfo, '/');
        $context = $this->context;
        $request = $this->request ?: $this->createRequest($pathinfo);
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if ('/_profiler' === $trimmedPathinfo) {
                    $ret = array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                    if ('/' === substr($pathinfo, -1)) {
                        // no-op
                    } elseif ('GET' !== $canonicalMethod) {
                        goto not__profiler_home;
                    } else {
                        return array_replace($ret, $this->redirect($rawPathinfo.'/', '_profiler_home'));
                    }

                    return $ret;
                }
                not__profiler_home:

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ('/_profiler/search' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ('/_profiler/search_bar' === $pathinfo) {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_phpinfo
                if ('/_profiler/phpinfo' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler_open_file
                if ('/_profiler/open' === $pathinfo) {
                    return array (  '_controller' => 'web_profiler.controller.profiler:openAction',  '_route' => '_profiler_open_file',);
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        elseif (0 === strpos($pathinfo, '/demande')) {
            // demande_homepage
            if ('/demande' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::indexAction',  '_route' => 'demande_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_demande_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'demande_homepage'));
                }

                return $ret;
            }
            not_demande_homepage:

            // demande
            if ('/demande/dem' === $pathinfo) {
                return array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::demandeAction',  '_route' => 'demande',);
            }

            // detailedem
            if (0 === strpos($pathinfo, '/demande/detaildem') && preg_match('#^/demande/detaildem/(?P<iddem>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'detailedem')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::detaildemAction',));
            }

            if (0 === strpos($pathinfo, '/demande/lstdem')) {
                // lst_demande
                if ('/demande/lstdem' === $pathinfo) {
                    return array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::lstdemandeAction',  '_route' => 'lst_demande',);
                }

                // listedemande_mobile
                if ('/demande/lstdemmobile' === $pathinfo) {
                    return array (  '_controller' => 'DemandeBundle\\Controller\\MobileDemandeController::lstdemmobileAction',  '_route' => 'listedemande_mobile',);
                }

            }

            // add_com
            if ('/demande/addcom' === $pathinfo) {
                return array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::addcomAction',  '_route' => 'add_com',);
            }

            // traitement_demande
            if (0 === strpos($pathinfo, '/demande/trait') && preg_match('#^/demande/trait/(?P<id>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'traitement_demande')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::traitementdemandeAction',));
            }

            if (0 === strpos($pathinfo, '/demande/rep')) {
                // repense_demande
                if (preg_match('#^/demande/rep/(?P<iddem>[^/]++)/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'repense_demande')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::repensedemandeAction',));
                }

                // repense_mobile
                if (0 === strpos($pathinfo, '/demande/repensemobile') && preg_match('#^/demande/repensemobile/(?P<rep>[^/]++)/(?P<iduser>[^/]++)/(?P<iddem>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'repense_mobile')), array (  '_controller' => 'DemandeBundle\\Controller\\MobileDemandeController::AjouterrepmobileAction',));
                }

            }

            elseif (0 === strpos($pathinfo, '/demande/mesdemande')) {
                // mes_demande
                if (preg_match('#^/demande/mesdemande/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'mes_demande')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::mesdemandeAction',));
                }

                // Refuser_dem
                if (preg_match('#^/demande/mesdemande/(?P<idrep>[^/]++)/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Refuser_dem')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::refuserdemAction',));
                }

                // Accepter_dem
                if (preg_match('#^/demande/mesdemande/(?P<idrep>[^/]++)/(?P<iddem>[^/]++)/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'Accepter_dem')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::accepterdemAction',));
                }

            }

            // modifier_dem
            if (0 === strpos($pathinfo, '/demande/modifierdem') && preg_match('#^/demande/modifierdem/(?P<iddem>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'modifier_dem')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::modifierdemAction',));
            }

            // supprimer_dem
            if (0 === strpos($pathinfo, '/demande/supprimerdem') && preg_match('#^/demande/supprimerdem/(?P<iddem>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'supprimer_dem')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::supprimerdemAction',));
            }

            // supprimer_com
            if (0 === strpos($pathinfo, '/demande/supprimercom') && preg_match('#^/demande/supprimercom/(?P<idcom>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'supprimer_com')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::supprimercomAction',));
            }

            // Gestion_Rep
            if (0 === strpos($pathinfo, '/demande/gesrep') && preg_match('#^/demande/gesrep/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'Gestion_Rep')), array (  '_controller' => 'DemandeBundle\\Controller\\DefaultController::gesrepsAction',));
            }

        }

        // evenement_homepage
        if ('/event' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'EvenementBundle\\Controller\\DefaultController::indexAction',  '_route' => 'evenement_homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_evenement_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'evenement_homepage'));
            }

            return $ret;
        }
        not_evenement_homepage:

        if (0 === strpos($pathinfo, '/produit')) {
            // produit_homepage
            if ('/produit' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::indexAction',  '_route' => 'produit_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_produit_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'produit_homepage'));
                }

                return $ret;
            }
            not_produit_homepage:

            // produit_ajout
            if ('/produit/ajouterpro' === $pathinfo) {
                return array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::ajoutAction',  '_route' => 'produit_ajout',);
            }

            if (0 === strpos($pathinfo, '/produit/listepro')) {
                // produit_liste
                if ('/produit/listepro' === $pathinfo) {
                    return array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::listeproAction',  '_route' => 'produit_liste',);
                }

                // liste_prod
                if ('/produit/listeprod' === $pathinfo) {
                    return array (  '_controller' => 'ProduitBundle\\Controller\\MobileProdController::listeprodmobileAction',  '_route' => 'liste_prod',);
                }

            }

            elseif (0 === strpos($pathinfo, '/produit/commande')) {
                // commande
                if (preg_match('#^/produit/commande/(?P<idpro>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commande')), array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::commandeAction',));
                }

                // commande_mobile
                if (preg_match('#^/produit/commande/(?P<qte>[^/]++)/(?P<prixc>[^/]++)/(?P<iduser>[^/]++)/(?P<idpro>[^/]++)$#sD', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'commande_mobile')), array (  '_controller' => 'ProduitBundle\\Controller\\MobileProdController::CommandeMobileAction',));
                }

            }

            // command_passer
            if ('/produit/commandpasser' === $pathinfo) {
                return array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::commandpasserAction',  '_route' => 'command_passer',);
            }

            // MesPrdouit
            if (0 === strpos($pathinfo, '/produit/mesproduit') && preg_match('#^/produit/mesproduit/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'MesPrdouit')), array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::mesproduitAction',));
            }

            // traiter_com
            if (0 === strpos($pathinfo, '/produit/traitercom') && preg_match('#^/produit/traitercom/(?P<id>[^/]++)/(?P<iduser>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'traiter_com')), array (  '_controller' => 'ProduitBundle\\Controller\\DefaultController::traitercomAction',));
            }

        }

        elseif (0 === strpos($pathinfo, '/profile')) {
            // fos_user_profile_show
            if ('/profile' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::showAction',  '_route' => 'fos_user_profile_show',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_fos_user_profile_show;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_profile_show'));
                }

                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_fos_user_profile_show;
                }

                return $ret;
            }
            not_fos_user_profile_show:

            // fos_user_profile_edit
            if ('/profile/edit' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ProfileController::editAction',  '_route' => 'fos_user_profile_edit',);
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_profile_edit;
                }

                return $ret;
            }
            not_fos_user_profile_edit:

            // fos_user_change_password
            if ('/profile/change-password' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ChangePasswordController::changePasswordAction',  '_route' => 'fos_user_change_password',);
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_change_password;
                }

                return $ret;
            }
            not_fos_user_change_password:

        }

        elseif (0 === strpos($pathinfo, '/service')) {
            // service_homepage
            if ('/service' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'ServiceBundle\\Controller\\DefaultController::indexAction',  '_route' => 'service_homepage',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_service_homepage;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'service_homepage'));
                }

                return $ret;
            }
            not_service_homepage:

            if (0 === strpos($pathinfo, '/service/ajouter')) {
                // service_ajoutpage
                if ('/service/ajouter' === $pathinfo) {
                    return array (  '_controller' => 'ServiceBundle\\Controller\\ServiceController::AjouterAction',  '_route' => 'service_ajoutpage',);
                }

                // service_ajoutpage_confirmer
                if ('/service/ajouter/confirmer' === $pathinfo) {
                    $ret = array (  '_controller' => 'ServiceBundle\\Controller\\ServiceController::AjoutServiceAction',  '_route' => 'service_ajoutpage_confirmer',);
                    if (!in_array($requestMethod, array('POST'))) {
                        $allow = array_merge($allow, array('POST'));
                        goto not_service_ajoutpage_confirmer;
                    }

                    return $ret;
                }
                not_service_ajoutpage_confirmer:

            }

            // service_ajoutpage_delegation
            if ('/service/delegation' === $pathinfo) {
                $ret = array (  '_controller' => 'ServiceBundle\\Controller\\ServiceController::DelegationAction',  '_route' => 'service_ajoutpage_delegation',);
                if (!in_array($requestMethod, array('POST'))) {
                    $allow = array_merge($allow, array('POST'));
                    goto not_service_ajoutpage_delegation;
                }

                return $ret;
            }
            not_service_ajoutpage_delegation:

            // service_listservicepage
            if ('/service/liste' === $pathinfo) {
                return array (  '_controller' => 'ServiceBundle\\Controller\\ServiceController::ListeAction',  '_route' => 'service_listservicepage',);
            }

            // service_listservicepage_filtres
            if ('/service/recherche' === $pathinfo) {
                $ret = array (  '_controller' => 'ServiceBundle\\Controller\\ServiceController::RechercheFiltreAction',  '_route' => 'service_listservicepage_filtres',);
                if (!in_array($requestMethod, array('POST'))) {
                    $allow = array_merge($allow, array('POST'));
                    goto not_service_listservicepage_filtres;
                }

                return $ret;
            }
            not_service_listservicepage_filtres:

        }

        // homepage
        if ('' === $trimmedPathinfo) {
            $ret = array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
            if ('/' === substr($pathinfo, -1)) {
                // no-op
            } elseif ('GET' !== $canonicalMethod) {
                goto not_homepage;
            } else {
                return array_replace($ret, $this->redirect($rawPathinfo.'/', 'homepage'));
            }

            return $ret;
        }
        not_homepage:

        if (0 === strpos($pathinfo, '/login')) {
            // login
            if (preg_match('#^/login/(?P<login>[^/]++)/(?P<pass>[^/]++)$#sD', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'login')), array (  '_controller' => 'AppBundle\\Controller\\DefaultController::loginAction',));
            }

            // fos_user_security_login
            if ('/login' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_security_login;
                }

                return $ret;
            }
            not_fos_user_security_login:

            // fos_user_security_check
            if ('/login_check' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                if (!in_array($requestMethod, array('POST'))) {
                    $allow = array_merge($allow, array('POST'));
                    goto not_fos_user_security_check;
                }

                return $ret;
            }
            not_fos_user_security_check:

        }

        // fos_user_security_logout
        if ('/logout' === $pathinfo) {
            $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                $allow = array_merge($allow, array('GET', 'POST'));
                goto not_fos_user_security_logout;
            }

            return $ret;
        }
        not_fos_user_security_logout:

        if (0 === strpos($pathinfo, '/register')) {
            // fos_user_registration_register
            if ('/register' === $trimmedPathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::registerAction',  '_route' => 'fos_user_registration_register',);
                if ('/' === substr($pathinfo, -1)) {
                    // no-op
                } elseif ('GET' !== $canonicalMethod) {
                    goto not_fos_user_registration_register;
                } else {
                    return array_replace($ret, $this->redirect($rawPathinfo.'/', 'fos_user_registration_register'));
                }

                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_registration_register;
                }

                return $ret;
            }
            not_fos_user_registration_register:

            // fos_user_registration_check_email
            if ('/register/check-email' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::checkEmailAction',  '_route' => 'fos_user_registration_check_email',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_fos_user_registration_check_email;
                }

                return $ret;
            }
            not_fos_user_registration_check_email:

            if (0 === strpos($pathinfo, '/register/confirm')) {
                // fos_user_registration_confirm
                if (preg_match('#^/register/confirm/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                    $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_registration_confirm')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmAction',));
                    if (!in_array($canonicalMethod, array('GET'))) {
                        $allow = array_merge($allow, array('GET'));
                        goto not_fos_user_registration_confirm;
                    }

                    return $ret;
                }
                not_fos_user_registration_confirm:

                // fos_user_registration_confirmed
                if ('/register/confirmed' === $pathinfo) {
                    $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\RegistrationController::confirmedAction',  '_route' => 'fos_user_registration_confirmed',);
                    if (!in_array($canonicalMethod, array('GET'))) {
                        $allow = array_merge($allow, array('GET'));
                        goto not_fos_user_registration_confirmed;
                    }

                    return $ret;
                }
                not_fos_user_registration_confirmed:

            }

        }

        elseif (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ('/resetting/request' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_fos_user_resetting_request;
                }

                return $ret;
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#sD', $pathinfo, $matches)) {
                $ret = $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
                if (!in_array($canonicalMethod, array('GET', 'POST'))) {
                    $allow = array_merge($allow, array('GET', 'POST'));
                    goto not_fos_user_resetting_reset;
                }

                return $ret;
            }
            not_fos_user_resetting_reset:

            // fos_user_resetting_send_email
            if ('/resetting/send-email' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
                if (!in_array($requestMethod, array('POST'))) {
                    $allow = array_merge($allow, array('POST'));
                    goto not_fos_user_resetting_send_email;
                }

                return $ret;
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ('/resetting/check-email' === $pathinfo) {
                $ret = array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
                if (!in_array($canonicalMethod, array('GET'))) {
                    $allow = array_merge($allow, array('GET'));
                    goto not_fos_user_resetting_check_email;
                }

                return $ret;
            }
            not_fos_user_resetting_check_email:

        }

        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
