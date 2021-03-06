<?php
/**
 * User: floran
 * Date: 30/10/2016
 * Time: 21:08
 */

namespace FrontBundle\Controller;

use BackBundle\Entity\Picture;
use BackBundle\Entity\Post;
use BackBundle\Utils\ImageResizer;
use FrontBundle\Form\AddPostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{

    public function showAction($postId)
    {
        $trans = $this->get('translator');
        $postManager = $this->get('manager.post');
        $postLikeManager = $this->get('manager.post_like');
        $postLikeProvider = $this->get('provider.post_like');

        $post = $postManager->loadOneBy(array('publicId' => $postId));
        if (!$post instanceof Post) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        $isLiking = $postLikeProvider->userIsLiking($post, $this->getUser());
        $likesCount =  $postLikeManager->countByPost($post->getId());
        $challengeSubject = $post->getChallengeSubject();
        $challenge = $challengeSubject->getChallenge();
        $subjectName = $trans->trans('challenge_frequency_type.element.'.$challenge->getFrequency()) . ' #' . $this->get('provider.challenge_subject')->getSequenceNumber($challengeSubject) . ' - ' . $challengeSubject->getName();

        return $this->render(
            'FrontBundle:Post:show.html.twig',
            array(
                'post' => $post,
                'metadata' => $post->getMetadata(),
                'challengeSubject' => $challengeSubject,
                'challenge' => $challenge,
                'likesCount' => $likesCount,
                'isLiking' => $isLiking,
                'subjectName' => $subjectName
            )
        );
    }

    public function addAction(Request $request)
    {
        if (!$this->isGranted('ROLE_USER')) {

            return $this->redirect($this->generateUrl('front_homepage'));
        }
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(AddPostType::class, $post);

        $form->handleRequest($request);
        $errors = $this->get('validator')->validate($post);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->get('service.post')->save($post);

                $message = $this->get('translator')->trans('post.message.success.added');
                $this->addFlash('success', $message);

                return $this->redirect($this->generateUrl('front_post_show', array('postId' => $post->getPublicId())));
            } catch (\Exception $e) {
                $form->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render(
            'FrontBundle:Post:add.html.twig',
            array(
                'form'   => $form->createView(),
                'errors' => $errors
            )
        );
    }

    public function ajaxRenderAddFormAction(Request $request)
    {
        $post = new Post();
        $post->setAuthor($this->getUser());
        $form = $this->createForm(AddPostType::class, $post, array(
            'action' => $this->generateUrl('api_post_add')
        ));

        $form->handleRequest($request);

        return $this->render(
            'FrontBundle:Post:form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}