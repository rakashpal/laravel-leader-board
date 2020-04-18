
<table>
    <tr>
      <th>Rank</th>
      <th>Name</th>
      <th>Total-Score</th>
    </tr>
    @if(!is_null($category))
    @foreach($category->scores as $key=> $score)
    <tr>
    <td>{{$key+1}}</td>
    <td>{{$score->user->name}}</td>
    {{-- <td>{{$score->score}}</td> --}}
      <td>{{$score->score1}}</td>
    </tr>
    @endforeach
    @endif
  </table>