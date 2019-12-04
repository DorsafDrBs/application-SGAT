@extends('layouts.app')

@section('content')

<a  data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Filtres <b class="caret"></b></a>
				<ul class="dropdown-menu" >					
					<li><a href="#" value="M"  id="M" class="dropdown-item  cper">Mensuelle</a></li>
					<li><a  href="#" value="T" id="T" class="dropdown-item cper ">Trimestrielle</a></li>
					<li><a  href="#" value="S" id="S" class="dropdown-item cper">Semesterielle</a></li>
                </ul>
                <script> let per;
               
                              
                              </script>
            
<script>
	$(".cper").click(function () {
							  per = $(this).attr("value");
                              alert(per);    });
</script>
@endsection