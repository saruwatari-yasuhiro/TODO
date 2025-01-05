<?php
App::uses('Component', 'Controller');

/**
 * ファイルアップロードを処理します。
 *
 * @param array $file アップロードするファイル情報
 * @param string $uploadDir アップロード先ディレクトリ名
 * @return string|false アップロードしたファイルのパス、失敗した場合は false
 */
class FileUploadComponent extends Component
{
    // ファイルをアップロードし、アップロードしたファイルのパスを返す
    public function uploadFile($file, $uploadDir = 'tasks')
    {
        if (!empty($file['name'])) {
            $uploadPath = WWW_ROOT . 'files' . DS . $uploadDir . DS;
            $filename = time() . '_' . basename($file['name']);
            $destination = $uploadPath . $filename;

            // ファイルをアップロード
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                return 'files/' . $uploadDir . '/' . $filename;
            } else {
                return false;
            }
        }
        return null;
    }
}
