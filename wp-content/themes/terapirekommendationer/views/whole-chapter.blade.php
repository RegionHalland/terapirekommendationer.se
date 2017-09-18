
            @while(have_posts())
                {!! the_post() !!}
                <h1>{{ the_title() }}</h1>
                {!! apply_filters('the_content', get_extended($post->post_content)['extended']) !!}
                {!! the_content() !!}
            @endwhile


                        @foreach ($parent->posts as $child)
                            <?php $content = $child->post_content;
                            $content = apply_filters('the_content', $content);
                            $content = str_replace(']]>', ']]&gt;', $content);
                            ?>

                            {!!$content!!}
                        @endforeach
