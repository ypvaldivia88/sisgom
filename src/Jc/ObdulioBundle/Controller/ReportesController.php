<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\ObdulioBundle\Repository\ReportesRepository;

class ReportesController extends Controller
{
    public function indexAction()
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        $unidades = $em->getRepository('JcObdulioBundle:Unidad')->findAll();


        return $this->render(
            'JcObdulioBundle:Reportes:index.html.twig',
            array(
                'listado' => $repo->getMesActual(),
                'tiposProducto' => $tiposProducto,
                'unidades' => $unidades,
            )
        );
    }

    public function detallesAction()
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();

        /* switch ($idReporte) {
            case 1:
                $listado = $repo->getOperativo();
                break;

            default:
                $listado = $repo->getMesActual();
                break;
        } */

        $listado = $repo->getOperativo();

        return $this->render(
            'JcObdulioBundle:Reportes:detalles.html.twig',
            array(
                'listado' => $listado,
                'tiposProducto' => $tiposProducto
            )
        );
    }

    public function operativoAction()
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);
        $tiposProducto = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();


        return $this->render(
            'JcObdulioBundle:Reportes:operativo.html.twig',
            array(
                'listado' => $repo->getOperativo(),
                'tiposProducto' => $tiposProducto
            )
        );
    }

    public function operativoTotalesAction($tipo)
    {
        if ($this->getUser() == NULL) {
            return $this->redirectToRoute('rh_usuarios_login');
        }

        $em = $this->getDoctrine()->getManager();
        $repo = new ReportesRepository($em);

        return $this->render(
            'JcObdulioBundle:Reportes:totales.html.twig',
            array('listado' => $repo->getTotales($tipo))
        );
    }
}
