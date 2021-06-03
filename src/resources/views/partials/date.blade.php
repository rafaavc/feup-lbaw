<span title="{{date($date)}}">
@php
    $date = new DateTime(date($date));
    $now = new DateTime(date("Y-m-d H:i:s"));
    $difference = date_diff($date, $now);

    if($difference->y > 1)
        echo $difference->y . " years ago";
    else if($difference->y === 1)
        echo $difference->y . " year ago";
    else if($difference->m > 1)
        echo $difference->m . " months ago";
    else if($difference->m === 1)
        echo $difference->m . " month ago";
    else if($difference->d > 1)
        echo $difference->d . " days ago";
    else if($difference->d === 1)
        echo $difference->d . " day ago";
    else if($difference->h > 1)
        echo $difference->h . " hours ago";
    else if($difference->h === 1)
        echo $difference->h . " hour ago";
    else if($difference->i > 1)
        echo $difference->i . " minutes ago";
    else if($difference->i === 1)
        echo $difference->i . " minute ago";
    else
        echo "just now";
@endphp
</span>
