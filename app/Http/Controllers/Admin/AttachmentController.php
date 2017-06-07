<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Attachment\StoreRequest;
use App\Repositories\Eloquents\AttachmentEloquentRepository;

class AttachmentController extends BaseController
{
    /**
     * [store 上传附件图片]
     * @return [type] [description]
     */
    public function store(StoreRequest $request, AttachmentEloquentRepository $attachmentRepository)
    {
        $type         = $request->get('type');
        $image        = $request->file('file');
        $originalName = $image->getClientOriginalName();
        $extension    = $image->getClientOriginalExtension();
        $mimeType     = $image->getClientMimeType();
        $filename     = mt_rand() . uniqid() . '.' . $extension;
        $filePath = (string) $image->move('assets/' . $type . date('/y/m/'), $filename);
        $createdEntity = $attachmentRepository->create([
            'relative_path'  => $filePath,
            'filename'       => $originalName,
            'tag'            => $request->get('tag'),
            'mime_types'     => $mimeType,
        ]);
        list($status, $attachment) = $createdEntity;

        return response()->json($attachment);
    }
}
