<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class ResourcesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createResourcesQrcode(Request $request) {
        $filename = $request->name . '.svg';
        $fileurl = 'http://h5.zhangguoheng.cn/?id=' . $request->name;
        $file = './' . $filename;
        if (file_exists($file)) {
            return [
                'code' => 200,
                'qrcode' => $file
            ];
        } else {
            $qrcode = new BaconQrCodeGenerator;
            $qrcode->format('svg')->size(500)->generate($fileurl, $filename);
            return [
                'code' => 200,
                'qrcode' => $file
            ];
        }
    }

    public function fetchResources() {
        $resources = DB::table('resources')->get();
        return [
            'code' => 200,
            'data' => $resources
        ];
    }

    public function fetchResourcesSound($id) {
        $resources = DB::table('resources')->where('index_id', $id)->get();
        return [
            'code' => 200,
            'data' => $resources
        ];
    }

    public function createResources(Request $request) {
        $name = $request->name;
        $desc = $request->desc;
        $type = $request->type;
        $url = $request->url;
        $author = $request->author;
        $singer = $request->singer;
        $res = DB::table('resources')->insert(
            [
                'name' => $name,
                'index_id' => time(),
                'desc' => $desc,
                'type' => $type,
                'url' => $url,
                'author' => $author,
                'singer' => $singer
            ]
        );
        if ($res) {
            return [
                'code' => 200,
                'data' => '添加成功'
            ];
        }
    }

    public function updateResources(Request $request) {
        $affected = DB::table('resources')
              ->where('id', $request->id)
              ->update([
                    'name' => $request->name,
                    'desc' => $request->desc,
                    'type' => $request->type,
                    'author' => $request->author,
                    'singer' => $request->singer
                ]);
        if ($affected) {
            return [
                'code' => 200,
                'data' => '编辑成功',
                'message' => $affected
            ];
        }   else {
            return [
                'code' => 304,
                'data' => '编辑失败',
                'message' => $affected
            ];
        }

    }

    public function deleteResources(Request $request) {
        $res = DB::table('resources')->where('id', $request->id)->delete();
        if ($res) {
            return [
                'code' => 200,
                'data' => '删除成功',
                'message' => $res
            ];
        }   else {
            return [
                'code' => 304,
                'data' => '删除失败',
                'message' => $res
            ];
        }
    }

    public function jwttoken(Request $request) {
        return [
            'code' => 200,
            'data' => 'keikeizhang'
        ];
    }

    public function upload(Request $request) {
        $root = $request->server('DOCUMENT_ROOT');
        $file = $request->file('file');
        $filePath = []; // 定义空数组用来存放图片路径
        $fileName = strtolower($file->getClientOriginalName());
        $fileExtendName = substr($fileName, strpos($fileName, '.'));
        $newFileName = uniqid() . mt_rand(1, 100000) . $fileExtendName;
        $file->move($root, $newFileName);
        $filePath = $newFileName;
        return [
            'code' => 200,
            'data' => $filePath
        ];
    }
}
