@extends('org.layouts.layout')

@section('title', $title)
@section('content')
    <section class="news1 m-auto">
        <div class="news-main1 m-auto"><a href="{{ route('home') }}" class="to_main_page">@lang('main.main')</a>
            <h1>@lang('home/home.header.navbar_li_a_fo-offers')</h1>
        </div>
    </section>
    <section class="blocks " style="background: none!important;">

        @foreach ($fo_offers as $fo_offer)
            @continue($fo_offer->__('desc') === false)
            <div class="b3 m-auto">
                <div class="adv ">
                    <div class="container">
                        <div class="row">
                            <!-- /.col-lg-2 -->
                            <div class="col-lg-2 col-sm-5 align-middle">
                                <img src="{{ $fo_offer->getImage() }}" alt="" style="width: 100%;" class="align-middle">
                            </div>
                            <div class="col-lg-5 col-sm-7  s2">
                                <h3>{{ $fo_offer->number ? '№'. $fo_offer->number : ''}} {{ $fo_offer->__('name') }}</h3>
                                <p class="p1">
                                <article>
                                    <div class="read-more js-read-more" data-rm-words="25">
                                        {!! $fo_offer->__('desc') !!}
                                    </div>
                                </article>
                                <p>
                                    @if ($fo_offer->phone)
                                        <strong>@lang('tender/tender.phone') </strong>{{ $fo_offer->phone }} <br>
                                    @endif
                                    @if ($fo_offer->faks)
                                        <strong>@lang('tender/tender.faks') </strong>{{ $fo_offer->faks }} <br>
                                    @endif
                                    @if ($fo_offer->email)
                                        <strong>@lang('tender/tender.email') </strong>{{ $fo_offer->email }} <br>
                                    @endif
                                    @if ($fo_offer->web)
                                        <strong>@lang('tender/tender.web')</strong>{{ $fo_offer->web }}
                                    @endif
                                </p>
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-3 offset-lg-2 col-sm-3 s3">
                                <a href="#"><h5>{{ $fo_offer->datesingle }}</h5></a>
                            </div><!-- /.col-lg-1 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div>
            </div>
        @endforeach
        <div class="offset-1">
            {{ $fo_offers->links() }}
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('assets/lib/readmore.js') }}"></script>

        {{-- readmore js --}}
        <script>
            /**
             *  Read More JS
             *  truncates text via specfied character length with more/less actions.
             *  Maintains original format of pre truncated text.
             *  @author stephen scaff
             *  @todo   Add destroy method for ajaxed content support.
             *
             */
            const ReadMore = (() => {
                let s;

                return {
                    settings() {
                        return {
                            content: document.querySelectorAll('.js-read-more'),
                            originalContentArr: [],
                            truncatedContentArr: [],
                            moreLink: "@lang('main.read_more')",
                            lessLink: "@lang('main.read_more_close')",
                        }
                    },

                    init() {
                        s = this.settings();
                        this.bindEvents();
                    },

                    bindEvents() {
                        ReadMore.truncateText();
                    },

                    /**
                     * Count Words
                     * Helper to handle word count.
                     * @param {string} str - Target content string.
                     */
                    countWords(str) {
                        return str.split(/\s+/).length;
                    },

                    /**
                     * Ellpise Content
                     * @param {string} str - content string.
                     * @param {number} wordsNum - Number of words to show before truncation.
                     */
                    ellipseContent(str, wordsNum) {
                        return str.split(/\s+/).slice(0, wordsNum).join(' ') + '...';
                    },

                    /**
                     * Truncate Text
                     * Truncate and ellipses contented content
                     * based on specified word count.
                     * Calls createLink() and handleClick() methods.
                     */
                    truncateText() {

                        for (let i = 0; i < s.content.length; i++) {
                            //console.log(s.content)
                            const originalContent = s.content[i].innerHTML;
                            const numberOfWords = s.content[i].dataset.rmWords;
                            const truncateContent = ReadMore.ellipseContent(originalContent, numberOfWords);
                            const originalContentWords = ReadMore.countWords(originalContent);

                            s.originalContentArr.push(originalContent);
                            s.truncatedContentArr.push(truncateContent);

                            if (numberOfWords < originalContentWords) {
                                s.content[i].innerHTML = s.truncatedContentArr[i];
                                let self = i;
                                ReadMore.createLink(self)
                            }
                        }
                        ReadMore.handleClick(s.content);
                    },

                    /**
                     * Create Link
                     * Creates and Inserts Read More Link
                     * @param {number} index - index reference of looped item
                     */
                    createLink(index) {
                        const linkWrap = document.createElement('span');

                        linkWrap.className = 'read-more__link-wrap';

                        linkWrap.innerHTML = `<a id="read-more_${index}"
                                        class="read-more__link"
                                        style="cursor:pointer;">
                                        ${s.moreLink}
                                    </a>`;

                        // Inset created link
                        s.content[index].parentNode.insertBefore(linkWrap, s.content[index].nextSibling);

                    },

                    /**
                     * Handle Click
                     * Toggle Click eve
                     */
                    handleClick(el) {
                        const readMoreLink = document.querySelectorAll('.read-more__link');

                        for (let j = 0, l = readMoreLink.length; j < l; j++) {

                            readMoreLink[j].addEventListener('click', function () {

                                const moreLinkID = this.getAttribute('id');
                                let index = moreLinkID.split('_')[1];

                                el[index].classList.toggle('is-expanded');

                                if (this.dataset.clicked !== 'true') {
                                    el[index].innerHTML = s.originalContentArr[index];
                                    this.innerHTML = s.lessLink;
                                    this.dataset.clicked = true;
                                } else {
                                    el[index].innerHTML = s.truncatedContentArr[index];
                                    this.innerHTML = s.moreLink;
                                    this.dataset.clicked = false;
                                }
                            });
                        }
                    },

                    /**
                     * Open All
                     * Method to expand all instances on the page.
                     * Will probably be useful with a destroy method.
                     */
                    openAll() {
                        const instances = document.querySelectorAll('.read-more__link');
                        for (let i = 0; i < instances.length; i++) {
                            content[i].innerHTML = s.truncatedContentArr[i];
                            instances[i].innerHTML = s.moreLink;
                        }
                    }
                }
            })();


            //export default ReadMore;

            ReadMore.init();
        </script>
    @endpush

@endsection
