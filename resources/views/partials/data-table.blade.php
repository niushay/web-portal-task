@foreach($data as $item)
    <tr>
        <td>{{$item->title}}</td>
        <td>{{$item->task}}</td>
        <td>{{$item->description}}</td>
        <td style="color: {{$item->colorCode}}">{{$item->colorCode}}</td>
    </tr>
@endforeach