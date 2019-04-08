<?php 

namespace App\Payload;

use Symfony\Component\Validator\Constraints as Assert;


class BienSearch {

    /**
     * @var int|null
     */
    private $prixMax;

    /**
     * @var int|null
     * @Assert\Range(min = 40, max = 500)
     */
    private $surfaceMin;

    /**
     * @return int|null
     */
    public function getPrixMax(): ?int
    {
        return $this->prixMax;
    }

    /**
     * @param int|null $prixMax
     * @return BienSearch
     */
    public function setPrixMax(int $prixMax): self
    {
        $this->prixMax = $prixMax;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSurfaceMin(): ?int
    {
        return $this->surfaceMin;
    }

    /**
     * @param int|null $surfaceMin
     * @return BienSearch
     */
    public function setSurfaceMin(int $surfaceMin): self
    {
        $this->surfaceMin = $surfaceMin;

        return $this;
    }
}