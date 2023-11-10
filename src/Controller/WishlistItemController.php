<?php

namespace App\Controller;

use App\Entity\WishlistItem;
use App\Entity\Wishlist;
use App\Form\WishlistItemType;
use App\Repository\WishlistItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wishlist/item')]
class WishlistItemController extends AbstractController
{
    #[Route('/', name: 'app_wishlist_item_index', methods: ['GET'])]
    public function index(WishlistItemRepository $wishlistItemRepository): Response
    {
        return $this->render('wishlist_item/index.html.twig', [
            'wishlist_items' => $wishlistItemRepository->findAll(),
        ]);
    }
    // TODO Corriger la fonction new en plaçant mieux l'id de la wishlist
    #[Route('/new/{wishlistId}', name: 'app_wishlist_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $wishlistId): Response
    {
        $wishlist = $entityManager->getRepository(Wishlist::class)->find($wishlistId);
        if (!$wishlist) {
            throw $this->createNotFoundException('Aucune wishlist trouvée pour l\'ID '.$wishlistId);
        }

        $wishlistItem = new WishlistItem();
        $wishlistItem->setWishlist($wishlist);

        $form = $this->createForm(WishlistItemType::class, $wishlistItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($wishlistItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_wishlist_show', ['id' => $wishlist->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('wishlist_item/new.html.twig', [
            'wishlist_item' => $wishlistItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_wishlist_item_show', methods: ['GET'])]
    public function show(WishlistItem $wishlistItem): Response
    {
        return $this->render('wishlist_item/show.html.twig', [
            'wishlist_item' => $wishlistItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_wishlist_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WishlistItem $wishlistItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WishlistItemType::class, $wishlistItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_wishlist_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('wishlist_item/edit.html.twig', [
            'wishlist_item' => $wishlistItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_wishlist_item_delete', methods: ['POST'])]
    public function delete(Request $request, WishlistItem $wishlistItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wishlistItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($wishlistItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_wishlist_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
