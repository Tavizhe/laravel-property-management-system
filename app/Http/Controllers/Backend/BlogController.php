<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\blogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {

        $category = blogCategory::latest()->get();

        return view('backend.category.blog_category', compact('category'));

    }

    // End Method
    public function StoreBlogCategory(Request $request)
    {

        blogCategory::insert([

            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = [
            'message' => 'blogCategory Create Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.blog.category')->with($notification);

    }// End Method

    public function EditBlogCategory($id)
    {

        $categories = blogCategory::findOrFail($id);

        return response()->json($categories);

    }// End Method

    public function AllPost()
    {

        $post = BlogPost::latest()->get();

        return view('backend.post.all_post', compact('post'));

    }// End Method

    public function AddPost()
    {

        $blogCat = blogCategory::latest()->get();

        return view('backend.post.add_post', compact('blogCat'));

    }// End Method

    public function StorePost(Request $request)
    {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;

        BlogPost::insert([
            'blogCat_id' => $request->blogCat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'BlogPost Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.post')->with($notification);

    }// End Method

    public function EditPost($id)
    {

        $blogCat = blogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);

        return view('backend.post.edit_post', compact('post', 'blogCat'));

    }// End Method

    public function UpdatePost(Request $request)
    {

        $post_id = $request->id;

        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('upload/post/'.$name_gen);
            $save_url = 'upload/post/'.$name_gen;

            BlogPost::findOrFail($post_id)->update([
                'blogCat_id' => $request->blogCat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.post')->with($notification);

        } else {

            BlogPost::findOrFail($post_id)->update([
                'blogCat_id' => $request->blogCat_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'BlogPost Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('all.post')->with($notification);

        } // end else

    }// End Method

    public function DeletePost($id)
    {

        $post = BlogPost::findOrFail($id);
        $img = $post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = [
            'message' => 'BlogPost Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }// End Method

    public function BlogDetails($slug)
    {

        $blog = BlogPost::where('post_slug', $slug)->first();

        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);

        $bCategory = blogCategory::latest()->get();
        $dPost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_details', compact('blog', 'tags_all', 'bCategory', 'dPost'));

    }// End Method

    public function blogCatList($id)
    {

        $blog = BlogPost::where('blogCat_id', $id)->get();
        $breadCat = blogCategory::where('id', $id)->first();
        $bCategory = blogCategory::latest()->get();
        $dPost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_cat_list', compact('blog', 'breadCat', 'bCategory', 'dPost'));

    }// End Method

    public function BlogList()
    {

        $blog = BlogPost::latest()->get();
        $bCategory = blogCategory::latest()->get();
        $dPost = BlogPost::latest()->limit(3)->get();

        return view('frontend.blog.blog_list', compact('blog', 'bCategory', 'dPost'));

    }// End Method

    public function StoreComment(Request $request)
    {

        $pid = $request->post_id;

        Comment::insert([
            'user_id' => Auth::user()->id,
            'post_id' => $pid,
            'parent_id' => null,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = [
            'message' => 'Comment Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }// End Method

    public function AdminBlogComment()
    {

        $comment = Comment::where('parent_id', null)->latest()->get();

        return view('backend.comment.comment_all', compact('comment'));

    }// End Method

    public function AdminCommentReply($id)
    {

        $comment = Comment::where('id', $id)->first();

        return view('backend.comment.reply_comment', compact('comment'));

    }// End Method

    public function ReplyMessage(Request $request)
    {

        $id = $request->id;
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        Comment::insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'parent_id' => $id,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = [
            'message' => 'Reply Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);

    }// End Method

    public function StoreSchedule(Request $request)
    {
        $aid = $request->agent_id;
        $pid = $request->property_id;

        if (Auth::check()) {

            Schedule::insert([

                'user_id' => Auth::user()->id,
                'property_id' => $pid,
                'agent_id' => $aid,
                'tour_date' => $request->tour_date,
                'tour_time' => $request->tour_time,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);

            $notification = [
                'message' => 'Send Request Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } else {

            $notification = [
                'message' => 'Plz Login Your Account First',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);

        }
    }// End Method

}
