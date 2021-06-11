<?php 

namespace App\Http\Controllers\Traits;

Trait DocumentUpload
{
    private function storeDocuments($file, $folder)
    {
        if (env('APP_ENV') == 'production') {
            return $this->localDocumentUpload($file, $folder);
        }

        // if local use this for default
        return $this->localDocumentUpload($file, $folder);
    }

    private function localDocumentUpload($file, $folder)
    {
        // get file extension
        $extension = $file->getClientOriginalExtension();

        // your file destination 
        $directoryTarget = 'document/' . $folder;

        //unique name for file 
        $filename = uniqid() . '.' . $extension;

        //finnaly move file to your destination
        $file->move($directoryTarget, $filename);

        /** will output
         * http://localhost:8000/ + directory target + filename
         */
        return url('/') . '/' . $directoryTarget . '/' . $filename;
    }
}

?>