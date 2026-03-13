@forelse ($sops as $index => $sop)
<tr>
    <td>{{ $index + 1 }}</td>

    <td class="fw-semibold">
        {{ $sop->title }}
    </td>

    <td>
        {{ $sop->department_names ?? '-' }}
    </td>

    <td>
        <a href="{{ route('admin.sop.view', Crypt::encryptString($sop->id)) }}" target="_blank" class="btn btn-soft btn-view">
            View
        </a>
    </td>

    <td>
        <span class="badge badge-active">
            ACTIVE
        </span>
    </td>

    <td>
        <div class="action-btns">

            <a href="{{ route('admin.sop.qa.create', $sop->id) }}"
               class="btn btn-soft btn-qa">
                Q&amp;A
            </a>

            <a href="{{ route('admin.sop.edit', $sop->id) }}"
               class="btn btn-soft btn-edit">
                Edit
            </a>

            <form action="{{ route('admin.sop.destroy', $sop->id) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this SOP?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-soft btn-delete">
                    Delete
                </button>
            </form>

        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="text-center text-muted py-4">
        No SOPs found
    </td>
</tr>
@endforelse
