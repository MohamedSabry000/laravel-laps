<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>

<h1>My Data</h1>

<table id="customers">
  <tr>
    <th>id</th>
    <th>Title</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>{{$post['id']}}</td>
    <td>{{$post['title']}}</td>
    <td>{{$post['desc']}}</td>
  </tr>
</table>