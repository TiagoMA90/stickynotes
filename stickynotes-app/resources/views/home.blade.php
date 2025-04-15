<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth <!-- If a User is Authenticated -->
        <!-- Display User's Name -->
        <h1>⌘ {{ auth()->user()->name }}</h1>
        
        <!-- Logout form -->
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        <!-- Create a post form -->
        <div style="border: 2px solid black; padding: 10px; margin:2.5px">
            <h2>Create a Sticky Note</h2>
            
            <form action="/create-post" method="POST">
                @csrf
                <div style="margin-bottom: 10px;">
                    <input style="width: 60%; padding: 5px;" type="text" name="title" placeholder="Post Title">
                </div>
                
                <div style="margin-bottom: 10px;">
                    <textarea style="width: 60%; height: 100px; padding: 5px;" name="body" placeholder="Body content..."></textarea>
                </div>
                <button type="submit" style="padding: 10px 20px; background-color:rgb(238, 224, 100); border: dashed 1px; cursor: pointer;">Create Post</button>
            </form>
        </div>
        
        <!-- Display all posts -->
        <div style="border: 2px solid black; margin:2.5px">
            <h2 style="margin-left: 10px">All Notes</h2>
            @foreach($posts as $post)
        <div style="background-color:rgb(238, 224, 100); padding: 10px; margin: 10px; 
            border: dashed 0.5px;
            border-radius: 1px; 
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
    
    <h3>
        {{$post["title"]}} by {{$post->user->name}}
        <span style="font-size: small; color: gray; font-weight: 300;">

            @if($post->created_at != $post->updated_at)
                (edited on {{ $post->updated_at->format('F j, Y \a\t g:i A') }})
            @else
                (posted on {{ $post->created_at->format('F j, Y \a\t g:i A') }})
            @endif
        </span>
    </h3>
    
    <p>{{$post["body"]}}</p>    

    <div style="margin-top: 10px;">
        @if(auth()->user()->id == $post->user_id)
            <p style="display: inline; margin-right: 10px;">
                <a href="/edit-post/{{$post->id}}" style="text-decoration: none; color: blue;">✎</a>
            </p>

            <form action="/delete-post/{{$post->id}}" method="POST" style="display:inline;">
                @csrf
                @method("DELETE")
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="text-decoration: none; color: red;">✖</a>
            </form>
        @endif
    </div>
</div>
@endforeach

        </div>

    @else <!-- If a User is not Authenticated -->
        <!-- Register a User form-->
        <div style="border: 2px solid black;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="name" placeholder="name">
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
            </form>
        </div>
        
        <!-- Log in -->
        <div style="border: 2px solid black;">
            <h2>Log in</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="name" placeholder="name">
                <input name="loginpassword" type="password" placeholder="password">
                <button>Login</button>
            </form>
        </div>
    @endauth
</body>
</html>
