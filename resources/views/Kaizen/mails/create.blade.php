<style>
    table tr>td:first-child{
        text-align: left;
        width: 50px;
        }
    td {
        vertical-align: top;
        border-bottom: 1px solid #ddd;
        }
    table{
        width: 600px;
    }
</style>
<p>
    Dear {{$kaizen->required->name}},<br><br>
    We would like to acknowledge that we have received your request and a Kaizen has been created.
</p> 
<table>
    <tr>
        <td><strong>Kaizen ID</strong></td>
        <td>{{$kaizen->id}}</td>
    </tr>
    <tr>
        <td><strong>Title</strong></td>
        <td>{{$kaizen->title}}</td>
    </tr>
    <tr>
        <td><strong>Group</strong></td>
        <td>{{$kaizen->group}}</td>
    </tr>
    <tr>
        <td><strong>Campaign</strong></td>
        <td>{{$kaizen->campaign}}</td>
    </tr>
    <tr>
        <td><strong>Type</strong></td>
        <td>{{$kaizen->type}}</td>
    </tr>
    <tr>
        <td><strong>Description</strong></td>
        <td>{!! $kaizen->description !!}</td>
    </tr>
</table>
<p>
    We will get in touch witd you soon.
</p>