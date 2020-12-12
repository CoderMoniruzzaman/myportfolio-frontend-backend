@extends('frontend.layouts.master')

@section('content')
<div class="mccan page">
    <h3 class="title-small">LOCATION</h3>
    <h2 class="title">Contact Me</h2>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <p>If you’d like to talk about a project, our work or anything else then get in touch.</p>
                <div class="list">
                    <ul>
                        <li><strong>Phone :</strong> +1 123 000 4444</li>
                        <li><strong>Email :</strong> info@mccan.com</li>
                        <li><strong>Address :</strong> 2 Curiosity Way, San Mateo, CA 94403, US.</li>
                        <li><strong>Map :</strong> <a href="#">via Google Maps</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="divider1"></div>
        <div class="row">
            <div class="col-md-8">
                <h6 class="mb-20"><strong>Get in touch</strong></h6>
                <form>
                    <div class="message d-none">
                        <div class="alert notice"></div>
                    </div>
                    <label for="name" class="screen-reader-text">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name *" required="">
                    <label for="email" class="screen-reader-text">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email *" required="">
                    <label for="message" class="screen-reader-text">Message</label>
                    <textarea name="message" id="message" cols="30" rows="5" placeholder="Message *" required=""></textarea>
                    <input type="submit" class="btn ajax" value="Say Hello"> </form>
            </div>
        </div>
    </div>
</div>
@endsection
