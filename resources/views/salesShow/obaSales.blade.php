<div class="carousel-item">
    <div class="logo_top">
        <img src="\img\salesShow\logo_enercare.png" alt="">
    </div>
    <div class="line">
        <h1 class="lob">OBA</h1>
    </div>
    <div class="card-deck">
        <div class="card">
            <h5 class="card-title1">
                {{-- /*daily sales service*/ --}}
                <span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid">
                <article>
                    <div class="center">
                        <div class="card-1">
                            <div class="header-gold">{{ $d_aOba1 }}</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOba1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">{{ $d_aOba3 }}</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOba3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">{{ $d_aOba2 }}</div>
                            <div class="content">
                                <p>
                                    {{ $d_aOba2Count }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                @if ($d_aOba4 == null)
                    <article class="listado_otros" style="opacity: 1">
                        <div class="banner-text">
                            <h2>No Sales <br> Here Yet</h2>
                        </div>
                        <div class="animation-area">
                            <ul class="box-area">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </article>
                @else
                    <article class="listado_otros">
                        <div class="parent">
                            <div class="div1">
                                <label class="label_otros_up" for="">4</label><br>
                                <label class="label_otros_up" for="">5</label><br>
                                <label class="label_otros_up" for="">6</label><br>
                                <label class="label_otros_up" for="">7</label><br>
                                <label class="label_otros_up" for="">8</label>
                            </div>
                            <div class="div2">
                                <input class="otros-izq" type="text" value="{{ $d_aOba4 }}"><br>
                                <input class="otros-izq" type="text" value="{{ $d_aOba5 }}"><br>
                                <input class="otros-izq" type="text" value="{{ $d_aOba6 }}"><br>
                                <input class="otros-izq" type="text" value="{{ $d_aOba7 }}"><br>
                                <input class="otros-izq" type="text" value="{{ $d_aOba8 }}">
                            </div>
                            <div class="div3">
                                <input type="text" class="otros-der" value="{{ $d_aOba4Count }}"><br>
                                <input type="text" class="otros-der" value="{{ $d_aOba5Count }}"><br>
                                <input type="text" class="otros-der" value="{{ $d_aOba6Count }}"><br>
                                <input type="text" class="otros-der" value="{{ $d_aOba7Count }}"><br>
                                <input type="text" class="otros-der" value="{{ $d_aOba8Count }}">
                            </div>
                        </div>
                    </article>
                @endif
            </main>
            <h5 class="card-title_b">
                {{-- /*weekly sales service*/ --}}
                <span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid2">
                <article>
                    <div class="center2">
                        <div class="card-1">
                            <div class="header-gold">{{ $w_aOba1 }}</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOba1Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">{{ $w_aOba3 }}</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOba3Count }}
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">{{ $w_aOba2 }}</div>
                            <div class="content">
                                <p>
                                    {{ $w_aOba2Count }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="listado_otros2">
                    <div class="parent">
                        <div class="div1">
                            <label class="label_otros_up" for="">4</label><br>
                            <label class="label_otros_up" for="">5</label><br>
                            <label class="label_otros_up" for="">6</label><br>
                            <label class="label_otros_up" for="">7</label><br>
                            <label class="label_otros_up" for="">8</label>
                        </div>
                        <div class="div2">
                            <input class="otros-izq" type="text" value="{{ $w_aOba4 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba5 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba6 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba7 }}"><br>
                            <input class="otros-izq" type="text" value="{{ $w_aOba8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="otros-der" value="{{ $w_aOba4Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba5Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba6Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba7Count }}"><br>
                            <input type="text" class="otros-der" value="{{ $w_aOba8Count }}">
                        </div>
                    </div>
                </article>
            </main>
        </div>
        <div class="card">
            @if ($d_sOba1 == null)
            <article class="listado_super" style="opacity: 1">
                <div class="no-sale">
                </div>
            </article>
            @else
            <article class="listado_super">
                <h5 class="card-title">
                    {{-- /*supervisor daily sales service*/ --}}
                    <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                    <span>&nbsp;</span><span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span>
                </h5>
                <div class="parent">
                    <div class="div1a">
                        <label class="label_otros" for="">1</label><br>
                        <label class="label_otros" for="">2</label><br>
                        <label class="label_otros" for="">3</label>
                    </div>
                    <div class="div2a">
                        <input class="otros-izq" type="text" value="{{ $d_sOba1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOba2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $d_sOba3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $d_sOba1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOba2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $d_sOba3Count }}">
                    </div>
                </div>
            </article>
            @endif
            <article class="listado_super1">
                <h5 class="card-title_s">
                    {{-- /*weekly supervisor service*/ --}}
                    <span>S</span><span>U</span><span>P</span><span>E</span><span>R</span><span>V</span><span>I</span><span>S</span><span>O</span><span>R</span>
                    <span>&nbsp;</span><span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span>
                </h5>
                <div class="parent">
                    <div class="div1a">
                        <label class="label_otros" for="">1</label><br>
                        <label class="label_otros" for="">2</label><br>
                        <label class="label_otros" for="">3</label>
                    </div>
                    <div class="div2a">
                        <input class="otros-izq" type="text" value="{{ $w_sOba1 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOba2 }}"><br>
                        <input class="otros-izq" type="text" value="{{ $w_sOba3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="otros-der" value="{{ $w_sOba1Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOba2Count }}"><br>
                        <input type="text" class="otros-der" value="{{ $w_sOba3Count }}">
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
