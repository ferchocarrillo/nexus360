<div class="carousel-item">
    <div class="logo_top">
        <img src="\img\salesShow\logo_enercare.png" alt="">
    </div>
    <div class="line">
        <h1 class="lob">CONVERSION BILLING</h1>
    </div>
    <div class="card-deck"
        style="background-image: url(/img/salesShow/fondoConverse2.jpg);background-repeat: no-repeat; background-size: cover; overflow: hidden; height: 100vh;">
        <div class="card">
            <h5 class="card-title1">
                {{-- /*daily sales billing*/ --}}
                <span>D</span><span>A</span><span>I</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid">
                <article>
                    <div class="center">
                        <div class="card-1">
                            <div class="header-gold">{{ $c_a_dBill1 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_a_dBill1Count }}%
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">{{ $c_a_dBill3 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_a_dBill3Count }}%
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">{{ $c_a_dBill2 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_a_dBill2Count }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                @if ($c_a_dBill4 == null)
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
                                <input class="c-otros-izq" type="text" value="{{ $c_a_dBill4 }}"><br>
                                <input class="c-otros-izq" type="text" value="{{ $c_a_dBill5 }}"><br>
                                <input class="c-otros-izq" type="text" value="{{ $c_a_dBill6 }}"><br>
                                <input class="c-otros-izq" type="text" value="{{ $c_a_dBill7 }}"><br>
                                <input class="c-otros-izq" type="text" value="{{ $c_a_dBill8 }}">
                            </div>
                            <div class="div3">
                                <input type="text" class="c-otros-der" value="{{ $c_a_dBill4Count }}%"><br>
                                <input type="text" class="c-otros-der" value="{{ $c_a_dBill5Count }}%"><br>
                                <input type="text" class="c-otros-der" value="{{ $c_a_dBill6Count }}%"><br>
                                <input type="text" class="c-otros-der" value="{{ $c_a_dBill7Count }}%"><br>
                                <input type="text" class="c-otros-der" value="{{ $c_a_dBill8Count }}%">
                            </div>
                        </div>
                    </article>
                @endif
            </main>
            <h5 class="card-title_b">
                {{-- /*weekly sales billing*/ --}}
                <span>W</span><span>E</span><span>E</span><span>K</span><span>L</span><span>Y</span><span>&nbsp;</span>
                <span>S</span><span>A</span><span>L</span><span>E</span><span>S</span>
            </h5>
            <main class="grid2">
                <article>
                    <div class="center2">
                        <div class="card-1">
                            <div class="header-gold">{{ $c_aBill1 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_aBill1Count }}%
                                </p>
                            </div>
                        </div>
                        <div class="card-2">
                            <div class="header-bronze">{{ $c_aBill3 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_aBill3Count }}%
                                </p>
                            </div>
                        </div>
                        <div class="card-3">
                            <div class="header-silver">{{ $c_aBill2 }}</div>
                            <div class="content">
                                <p class="card-datos">
                                    {{ $c_aBill2Count }}%
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="c-listado_otros2">
                    <div class="parent">
                        <div class="div1">
                            <label class="label_otros_up" for="">4</label><br>
                            <label class="label_otros_up" for="">5</label><br>
                            <label class="label_otros_up" for="">6</label><br>
                            <label class="label_otros_up" for="">7</label><br>
                            <label class="label_otros_up" for="">8</label>
                        </div>
                        <div class="div2">
                            <input class="c-otros-izq" type="text" value="{{ $c_aBill4 }}"><br>
                            <input class="c-otros-izq" type="text" value="{{ $c_aBill5 }}"><br>
                            <input class="c-otros-izq" type="text" value="{{ $c_aBill6 }}"><br>
                            <input class="c-otros-izq" type="text" value="{{ $c_aBill7 }}"><br>
                            <input class="c-otros-izq" type="text" value="{{ $c_aBill8 }}">
                        </div>
                        <div class="div3">
                            <input type="text" class="c-otros-der" value="{{ $c_aBill4Count }}%"><br>
                            <input type="text" class="c-otros-der" value="{{ $c_aBill5Count }}%"><br>
                            <input type="text" class="c-otros-der" value="{{ $c_aBill6Count }}%"><br>
                            <input type="text" class="c-otros-der" value="{{ $c_aBill7Count }}%"><br>
                            <input type="text" class="c-otros-der" value="{{ $c_aBill8Count }}%">
                        </div>
                    </div>
                </article>
            </main>
        </div>
            <div class="card">
                @if ($c_s_dBill1 == null)
                    <article class="listado_super" style="opacity: 1">
                        <div class="no-sale">
                        </div>
                    </article>
                @else
            <article class="listado_super">
                <h5 class="card-title">
                    {{-- /*supervisor daily sales billing*/ --}}
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
                        <input class="c-otros-izq" type="text" value="{{ $c_s_dBill1 }}"><br>
                        <input class="c-otros-izq" type="text" value="{{ $c_s_dBill2 }}"><br>
                        <input class="c-otros-izq" type="text" value="{{ $c_s_dBill3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="c-otros-der" value="{{ $c_s_dBill1Count }}%"><br>
                        <input type="text" class="c-otros-der" value="{{ $c_s_dBill2Count }}%"><br>
                        <input type="text" class="c-otros-der" value="{{ $c_s_dBill3Count }}%">
                    </div>
                </div>
            </article>
            @endif
            <article class="listado_super1">
                <h5 class="card-title_s">
                    {{-- /*weekly supervisor billing*/ --}}
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
                        <input class="c-otros-izq" type="text" value="{{ $c_sBill1 }}"><br>
                        <input class="c-otros-izq" type="text" value="{{ $c_sBill2 }}"><br>
                        <input class="c-otros-izq" type="text" value="{{ $c_sBill3 }}">
                    </div>
                    <div class="div3a">
                        <input type="text" class="c-otros-der" value="{{ $c_sBill1Count }}%"><br>
                        <input type="text" class="c-otros-der" value="{{ $c_sBill2Count }}%"><br>
                        <input type="text" class="c-otros-der" value="{{ $c_sBill3Count }}%">
                    </div>
                </div>
            </article>
        </div>
    </div>
</div>
