<?php

namespace App\Http\Controllers;

use App\Models\SejarahLembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SejarahLembagaController extends Controller
{
    public function index()
    {
        $sejarah = SejarahLembaga::first();
        if (!$sejarah) {
            $sejarah = SejarahLembaga::create([
                'badge_text' => 'PERJALANAN KAMI',
                'title' => 'Sejarah Lembaga',
                'content' => 'didirikan atas dasar kepedulian dan bentuk aksi nyata untuk berkontribusi aktif dalam upaya pengentasan masalah sosial di tengah masyarakat melalui serangkaian program pemberdayaan ekonomi, pendidikan, kesehatan, lingkungan, dan kebencanaan.',
                'institution_name' => 'Yayasan Energi Kebaikan Indonesia',
                'is_active' => true,
            ]);
        }
        return view('admin.sejarah', compact('sejarah'));
    }

    public function update(Request $request, $id)
    {
        try {
            $sejarah = SejarahLembaga::findOrFail($id);

            $request->validate([
                'badge_text' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'institution_name' => 'nullable|string|max:255',
            ]);

            $sejarah->badge_text = $request->badge_text;
            $sejarah->title = $request->title;
            $sejarah->content = $request->content;
            $sejarah->institution_name = $request->institution_name;
            $sejarah->save();

            return redirect()->route('admin.sejarah')->with('success', 'Sejarah Lembaga berhasil diupdate!');
        } catch (\Exception $e) {
            Log::error('Sejarah update error: ' . $e->getMessage());
            return redirect()->route('admin.sejarah')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
