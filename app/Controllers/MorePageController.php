<?php namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\BookMark;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Product;
use App\Models\Score;
use App\Models\User;
class MorePageController extends Controller
{
    protected Product $products;
    protected BookMark $bookmarks;
    protected Like $likes;
    protected Score $scores;
    protected Comment $comment;
    protected User $users;

    public function __construct()
    {
        $this->product = new Product;
        $this->bookmark = new BookMark;
        $this->like = new Like;
        $this->score = new Score;
        $this->comment = new Comment;
        $this->user = new User;
    }
    // render more page
    public function more()
    {
        // get product id url
        $id = $_GET['id'];

        //get user id
        $userId = session()->get('user');
        // $userId = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // get product for show in more page
        $product = $this->product->where('id', $id)->first();

        // reply or return function
        $comment = $this->user->groupCommentByParent($id);

        //  get all like for this product
        $likeCount = $this->like->likeCount( $id);

        // avg score
        // $score = Data::avgScore('scores', $id);

        // is user book mark this product
        $isBookmark = $this->bookmark->getUserBookmark($id, $userId);

        // params for send into view
        return $this->render('product/single/singlePage', compact('product', 'comment', 'likeCount', 'isBookmark'));
    }

    // add like product
    public function addLike()
    {
        $data = $_REQUEST;

        // check login for login
        if (!auth()->check()) {
            return redirect('/login');
        } else {
            $data = $_REQUEST;
            // add user id to the data
            $data['user_id'] = session()->get('user');

            // validate the value
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->like->like($data, $userId, $productId);

            if (!$result) {
                redirect("/more?id={$productId}");
            }
            redirect("/more?id={$productId}");
        }
    }
    // add bookmark product
    public function addBookMark()
    {
        $data = $_REQUEST;

        if (!auth()->check()) {
            return redirect('/login');
        } else {
            $data['user_id'] = session()->get('user');
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->bookmark->bookmark($data, $userId, $productId);

            if (!$result) {
                redirect("/more?id={$productId}");
            }
            redirect("/more?id={$productId}");
        }
    }
    // add score product
    public function addScore()
    {
        $data = $_REQUEST;

        if (!auth()->check()) {
            return redirect('/login');
        } else {
            $data['user_id'] = session()->get('user');
            $userId = $data['user_id'];
            $productId = $data['product_id'];

            $result = $this->score->score($data, $userId, $productId);

            if ($result) {
                redirect("/more?id={$data['product_id']}");
            }

            redirect("/more?id={$data['product_id']}");
        }

    }
    // add comment for product
    public function addComment()
    {
        // get data
        $data = $_REQUEST;
        // check user login
        if (!auth()->check()) {
            return redirect('/login');
        } else {
            // create user id
            $data['user_id'] = session()->get('user');
            // insert data into user table
            $result = $this->comment->create($data);

            if (!$result) {
                redirect("/more?id={$data['product_id']}");
            }

            redirect("/more?id={$data['product_id']}");
        }
    }

}
