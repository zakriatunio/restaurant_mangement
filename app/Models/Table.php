<?php

namespace App\Models;

use App\Helper\Files;
use App\Traits\HasBranch;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use App\Traits\GeneratesQrCode;

class Table extends Model
{

    use HasFactory;
    use HasBranch;
    use GeneratesQrCode;

    protected $guarded = ['id'];

    protected $casts = [
        'pictures' => 'array'
    ];

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function activeOrder(): HasOne
    {
        return $this->hasOne(Order::class)->whereIn('status', ['billed', 'kot']);
    }

    public function qRCodeUrl(): Attribute
    {
        return Attribute::get(fn(): string => asset_url_local_s3('qrcodes/' . $this->getQrCodeFileName()));
    }

    public function generateQrCode()
    {
        $this->createQrCode(route('table_order', [$this->hash]), __('modules.table.table') . ' ' . str()->slug($this->table_code));
    }

    public function getQrCodeFileName(): string
    {
        return 'qrcode-' . $this->branch_id . '-' . str()->slug($this->table_code) . '.png';
    }

    public function getRestaurantId(): int
    {
        return $this->branch?->restaurant_id;
    }

    public function activeWaiterRequest(): HasOne
    {
        return $this->hasOne(WaiterRequest::class)->where('status', 'pending');
    }

    public function waiterRequests(): HasMany
    {
        return $this->hasMany(WaiterRequest::class);
    }

    public function addPicture($path, $isPanorama = false)
    {
        $pictures = $this->pictures ?? [];
        $pictures[] = [
            'path' => $path,
            'is_panorama' => $isPanorama
        ];
        $this->update(['pictures' => $pictures]);
    }

    public function removePicture($index)
    {
        $pictures = $this->pictures ?? [];
        if (isset($pictures[$index])) {
            Storage::disk('public')->delete($pictures[$index]['path']);
            unset($pictures[$index]);
            $pictures = array_values($pictures);
            $this->update(['pictures' => $pictures]);
        }
    }

    public function getPanoramaPicture()
    {
        $pictures = $this->pictures ?? [];
        foreach ($pictures as $picture) {
            if (isset($picture['is_panorama']) && $picture['is_panorama']) {
                return $picture['path'];
            }
        }
        return null;
    }

    public function getRegularPictures()
    {
        $pictures = $this->pictures ?? [];
        return array_filter($pictures, function($picture) {
            return !isset($picture['is_panorama']) || !$picture['is_panorama'];
        });
    }
}
