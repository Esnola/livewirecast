public string $period = 'month';

#[Computed]
public function views()
{
    return Analytics::period($this->period)->views();
}

#[Computed]
public function visitors()
{
    return Analytics::period($this->period)->visitors();
}

#[Computed]
public function avgTime()
{
    return Analytics::period($this->period)->avgTime();
}

#[Computed]
public function topPosts()
{
    return Analytics::period($this->period)->topPosts();
}

#[Computed]
public function topCountries()
{
    return Analytics::period($this->period)->topCountries();
}
