<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BlogController extends AbstractController
{
  const DESCRIPTION = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mauris urna, faucibus id turpis sed, suscipit pulvinar eros. Fusce sollicitudin vel ante lobortis egestas. Nulla quis varius leo. Fusce sapien risus, suscipit sed lorem vel, venenatis consequat est. Nunc volutpat, est quis molestie hendrerit, urna ipsum volutpat lorem, placerat auctor ex nulla a tellus. Nullam dapibus ligula ex, sed egestas eros lobortis vitae. Ut aliquet sodales ante eu tincidunt. Etiam venenatis consectetur lectus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus eleifend sed lectus in faucibus. Mauris pretium suscipit urna vitae fermentum. Sed risus diam, porta quis facilisis eu, scelerisque in metus. Nam nec ipsum mollis, sollicitudin leo eget, congue massa. Nunc nec sem et est mattis dapibus et placerat magna.

Suspendisse sit amet nisl sed tellus auctor dictum non eu lectus. Ut tempus dapibus tellus, quis efficitur enim consequat ac. Nullam accumsan eleifend ipsum, sit amet pellentesque est rhoncus auctor. Mauris viverra, mauris et rhoncus vestibulum, nisl mauris dignissim quam, mattis convallis libero massa eu augue. Quisque in dictum est, at egestas lorem. Aliquam nibh est, cursus et lectus vitae, dignissim dictum lorem. In varius orci condimentum, lobortis nulla pellentesque, gravida eros. Fusce non dignissim ligula. Curabitur posuere, erat at tincidunt pellentesque, libero nunc pellentesque eros, id ultricies nisi metus vel mauris. Nullam vel hendrerit neque, eu ultricies turpis.

Nullam eu maximus mauris. Ut pharetra ligula at ligula rutrum, et luctus risus vulputate. Ut eget elementum quam. In hac habitasse platea dictumst. Quisque porttitor eget velit id posuere. Ut vitae est sem. Donec tincidunt quam in ligula volutpat venenatis. Nulla ullamcorper imperdiet libero eget rutrum.

Donec malesuada ut nisl ut dignissim. Nulla ultricies diam nec lectus lobortis hendrerit. Aenean molestie dui non augue convallis, ut suscipit purus consequat. Suspendisse eget ultrices nibh. In pharetra lectus ligula, in sollicitudin leo fringilla a. Nam at euismod leo. Morbi metus turpis, tempus vel lacus placerat, fermentum rhoncus tellus. Aenean ornare est eu urna faucibus, pulvinar interdum elit porttitor. Duis egestas vestibulum libero et eleifend. Aenean dignissim, lectus faucibus molestie tincidunt, erat mauris venenatis ipsum, finibus suscipit magna lacus at tortor. Aenean ut cursus tortor. Aliquam at sapien lectus. Pellentesque ac sollicitudin turpis. Nullam laoreet eros sit amet dolor ullamcorper suscipit. In ultrices feugiat rhoncus. Nunc sodales eros ut consequat malesuada.

Nam pellentesque diam non pharetra tincidunt. Quisque metus velit, luctus sed est in, fermentum sagittis nisl. Vestibulum fermentum quam quis lorem tristique eleifend. Quisque mollis varius sem, in venenatis odio ullamcorper in. Vestibulum feugiat elit vel imperdiet pulvinar. Aliquam in massa a lacus pellentesque facilisis sed semper purus. Proin iaculis elementum egestas. Vivamus elit sem, ornare ornare magna rhoncus, mattis rutrum lorem. Maecenas maximus justo condimentum metus tempus ullamcorper. Curabitur hendrerit malesuada leo, non porttitor justo hendrerit malesuada. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum varius ligula et sollicitudin pharetra. Etiam non tellus quam. Maecenas ac lobortis nulla. Morbi vitae eros urna.";

  public $posts = [
    array("title" => "Hello World", "slug" => "hello-world", "picture" => "https://picsum.photos/300/200", "description" => self::DESCRIPTION),
    array("title" => "Hello World 2", "slug" => "hello-world-2", "picture" => "https://picsum.photos/300/200", "description" => self::DESCRIPTION),
  ];

  #[Route('/blog', name: 'blog_list')]
  public function list(): Response
  {
    return $this->render('blog/blog_list.html.twig', [
      'posts' => $this->posts,
    ]);
  }

  #[Route('/blog/{slug}', name: 'blog_show')]
  public function show(string $slug): Response
  {
    $postToShow = array_filter($this->posts, function ($post) use ($slug) {
      return $post['slug'] == $slug;
    });
    $postToShow = reset($postToShow);
    return $this->render('blog/blog_article.html.twig', [
      'post' => $postToShow,
    ]);
  }
}
