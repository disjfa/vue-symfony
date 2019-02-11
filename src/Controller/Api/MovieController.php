<?php

namespace App\Controller\Api;

use App\Entity\Movie;
use App\Form\Errors\Serializer;
use App\Form\Type\MovieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

/**
 * @Route("/api/movies")
 */
class MovieController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all movies",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Movie::class, groups={"full"}))
     *     )
     * )
     */
    public function index()
    {
        return new JsonResponse($this->entityManager->getRepository(Movie::class)->findAll());
    }

    /**
     * @Route("/token", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns csrf token",
     *     @SWG\Schema(
     *          @SWG\Property(property="token", type="string"),
     *     )
     * )
     *
     * @param CsrfTokenManagerInterface $tokenManager
     *
     * @return JsonResponse
     */
    public function token(CsrfTokenManagerInterface $tokenManager)
    {
        $form = $this->createForm(MovieType::class);

        return new JsonResponse([
            'token' => $tokenManager->getToken($form->getName())->getValue(),
        ]);
    }

    /**
     * @Route("", methods={"POST"})
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="JSON Payload",
     *     required=true,
     *     format="application/json",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="_token", type="string"),
     *         @SWG\Property(property="name", type="string", example="Star wars"),
     *         @SWG\Property(property="release_date", type="string", example="1977-05-25"),
     *     )
     * ),
     * @SWG\Response(
     *     response=200,
     *     description="Returns movie when created",
     *     @Model(type=Movie::class),
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returns errors when not created",
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $form = $this->createForm(MovieType::class);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Movie $movie */
            $movie = $form->getData();
            $this->entityManager->persist($movie);
            $this->entityManager->flush();

            return new JsonResponse($movie);
        }

        return new JsonResponse(['error' => Serializer::serialize($form)], 400);
    }

    /**
     * @Route("/{movie}", methods={"PATCH"})
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="JSON Payload",
     *     required=true,
     *     format="application/json",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="_token", type="string"),
     *         @SWG\Property(property="name", type="string", example="Star wars"),
     *         @SWG\Property(property="release_date", type="string", example="1977-05-25"),
     *     )
     * ),
     * @SWG\Response(
     *     response=200,
     *     description="Returns movie when created",
     *     @SWG\Items(ref=@Model(type=Movie::class, groups={"full"}))
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returns errors when not updated",
     * )
     *
     * @param Request $request
     * @param Movie   $movie
     *
     * @return JsonResponse
     */
    public function patch(Request $request, Movie $movie)
    {
        $form = $this->createForm(MovieType::class, $movie);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Movie $movie */
            $movie = $form->getData();
            $this->entityManager->persist($movie);
            $this->entityManager->flush();

            return new JsonResponse($movie);
        }

        return new JsonResponse(['error' => Serializer::serialize($form)], 400);
    }
}
