@php $a = 0 @endphp
@foreach ($students as $allEligibleStudent)
<tr>
    @if(checkPermission(['Admin','viceChancellor','surveyAccess']))
    <td>{{ ++$a }}</td>
    @include('component.allEligibleStudentsTableComponent')
    @endif
    @foreach(['EBSC_Applied' => 'Applied Sciences', 'EBSC_Geo' => 'Geomatics', 'EBSC_Social' => 'Social Sciences & Languages', 'EBSC_Mana' => 'Management Studies', 'EBSC_Med' => 'Medicine', 'EBSC_Agri' => 'Agricultural Sciences', 'EBSC_Tech' => 'Technology', 'EBSC_GS' => 'Graduate Studies', 'EBSC_Computing' => 'Computing', 'EBSC_CIKCS' => 'Indigenous Knowledge & Community Studies'] as $role => $faculty)
    @if(checkPermission([$role]) && $allEligibleStudent->faculty == $faculty)
    <td>{{ ++$a }}</td>
    @include('component.allEligibleStudentsTableComponent')
    @endif
    @endforeach
    @if(checkPermission(['Admin']))
    <td>
        <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" value="Not Yet" name="cloakIssueDate">
            <input type="checkbox" value={{Carbon\Carbon::now()}} name="cloakIssueDate" @if($allEligibleStudent->cloakIssueDate!='Not Yet') checked @endif>
            <div>{{ $allEligibleStudent->cloakIssueDate }}</div>
            <button type="submit" class="btn btn-success btn-sm">Update</button>
        </form>
    </td>
    <td>
        <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" value="Not Yet" name="cloakReturnDate">
            <input type="checkbox" value={{Carbon\Carbon::now()}} name="cloakReturnDate" @if($allEligibleStudent->cloakReturnDate!='Not Yet') checked @endif>
            <div>{{ $allEligibleStudent->cloakReturnDate }}</div>
            <button type="submit" class="btn btn-info btn-sm">Update</button>
        </form>
    </td>
    <td>
        <form action="{{ route('eligibleStudents.update',$allEligibleStudent->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" value="Not Yet" name="garlandReturnDate">
            <input type="checkbox" value={{Carbon\Carbon::now()}} name="garlandReturnDate" @if($allEligibleStudent->garlandReturnDate!='Not Yet') checked @endif>
            <div>{{ $allEligibleStudent->garlandReturnDate }}</div>
            <button type="submit" class="btn btn-danger btn-sm">Update</button>
        </form>
    </td>
    @endif
</tr>
@endforeach
