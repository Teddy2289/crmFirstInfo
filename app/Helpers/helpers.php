<?php

function formatDateFr($date)
{
    return \Carbon\Carbon::parse($date)->format('d M Y');
}
