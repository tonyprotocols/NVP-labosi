@extends('layouts.app')

@section('content')
<!– Pogled resources/views/pozdrav.php -->
<html>
   <body>
	<h1>Dobro došao. <?php echo $pozdrav; echo $ime; ?></h1>
  Trenutno vrijeme {{date('d.m.Y.')}} {{$pozdrav}}
  <br><br>
  @for ($i = 0; $i < 10; $i++)
  Vrijednost od i je {{ $i }} <br>
  @endfor

  <br><br>
  <?php echo with(new DateTime())->format('d.m.Y. H:i'); ?>

  </body>
</html>
@endsection
