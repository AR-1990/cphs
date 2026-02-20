<!-- resources/views/pdf/view.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data PDF</title>
</head>
<body>
    <h1>Data for PDF</h1>

   
        <tbody>
            @foreach ($details as $item)


            <div class="col-md-6 mb-3">
                    <div class="card_color">
                        <h5 class="card-title">{{ str_replace('_', ' ', $item->key) }}</h5>
                       @if($item->value !== null)
                                    @if ($item->key == 'city')
                                       @foreach ($city as $cit)
                                           @if ($item->value ==  $cit->id)
                                           <p class="card-text">{{ str_replace('_', ' ', $cit->name) }}</p>
                                           @endif
                                       @endforeach
                                   @elseif($item->key == 'area')
                                       @foreach ($area as $ar)
                                           @if ($item->value ==  $ar->id)
                                           <p class="card-text">{{ str_replace('_', ' ', $ar->name) }}</p>
                                           @endif
                                       @endforeach
                                   @elseif($item->key == 'school')
                                       @foreach ($school as $sc)
                                           @if ($item->value ==  $sc->id)
                                           <p class="card-text">{{ str_replace('_', ' ', $sc->school_name) }}</p>
                                           @endif

                                        @endforeach
                                        <form action="{{ url('/download-pdf') }}" method="GET">
                                            <button type="submit">Download PDF</button>
                                        </form>
                               @else

                               <p class="card-text">{{ str_replace('_', ' ', $item->value) }}</p>
                               @endif

                   @else
                       <p class="card-text">None</p>
                   @endif
                      </div>
                      </div>
       @endforeach
        </tbody>
    </table>
</body>
</html>
