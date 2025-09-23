@php
    $company     = config('legal.company_name', config('app.name', 'Uthix'));
    $entity      = config('legal.legal_entity', $company);
    $contactMail = config('legal.contact_email', 'privacy@uthix.com');
    $dpoMail     = config('legal.dpo_email', null);
    $address     = config('legal.contact_address', 'Your full postal address here');
    $country     = config('legal.country', 'India');
    $updated     = config('legal.last_updated', now()->toFormattedDateString());
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Privacy Policy — {{ $company }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ $company }} Privacy Policy for e-commerce and e-learning services. Learn what data we collect, why, how long we keep it, and your privacy rights. Last updated {{ $updated }}.">
     <script src="https://cdn.tailwindcss.com"></script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "PrivacyPolicy",
      "name": "Privacy Policy — {{ $company }}",
      "url": "{{ url()->current() }}",
      "publisher": {
        "@type": "Organization",
        "name": "{{ $entity }}"
      },
      "dateModified": "{{ \Illuminate\Support\Carbon::parse($updated)->toDateString() }}"
    }
    </script>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <header class="border-b bg-white">
        <div class="mx-auto max-w-6xl px-4 py-6">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl md:text-3xl font-semibold">Privacy Policy</h1>
                <button onclick="window.print()"
                        class="rounded-lg border px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Print
                </button>
            </div>
            <p class="mt-1 text-sm text-gray-600">Last updated: {{ $updated }}</p>
            <p class="mt-2 text-gray-700">
                This Privacy Policy explains how {{ $company }} (“we”, “us”, “our”) collects, uses, discloses, and protects
                your information when you use our e-commerce and e-learning services (the “Platform”).
                It applies to our websites, mobile apps, and related services.
                <span class="block mt-2 text-xs text-gray-500">This page is for general information and does not constitute legal advice.</span>
            </p>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- TOC -->
            <aside class="lg:col-span-3 lg:sticky lg:top-6 self-start">
                <nav class="rounded-xl border bg-white p-4">
                    <h2 class="text-sm font-semibold text-gray-700">On this page</h2>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="#data-we-collect" class="hover:underline">1. Data we collect</a></li>
                        <li><a href="#how-we-use" class="hover:underline">2. How we use your data</a></li>
                        <li><a href="#legal-bases" class="hover:underline">3. Legal bases</a></li>
                        <li><a href="#cookies" class="hover:underline">4. Cookies & tracking</a></li>
                        <li><a href="#payments" class="hover:underline">5. Payments</a></li>
                        <li><a href="#elearning" class="hover:underline">6. E-learning data</a></li>
                        <li><a href="#ugc" class="hover:underline">7. User content & communities</a></li>
                        <li><a href="#sharing" class="hover:underline">8. Sharing & processors</a></li>
                        <li><a href="#intl" class="hover:underline">9. International transfers</a></li>
                        <li><a href="#retention" class="hover:underline">10. Data retention</a></li>
                        <li><a href="#security" class="hover:underline">11. Security</a></li>
                        <li><a href="#rights" class="hover:underline">12. Your rights</a></li>
                        <li><a href="#children" class="hover:underline">13. Children’s privacy</a></li>
                        <li><a href="#changes" class="hover:underline">14. Changes</a></li>
                        <li><a href="#contact" class="hover:underline">15. Contact</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- Content -->
            <section class="lg:col-span-9 space-y-10">
                <div id="data-we-collect" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">1) Data we collect</h2>
                    <div class="mt-4 grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-medium">Account & identity</h3>
                            <ul class="mt-2 list-disc pl-5 text-gray-700">
                                <li>Name, username, password (hashed), profile photo</li>
                                <li>Email, phone, billing/shipping address</li>
                                <li>Role (learner, instructor, merchant, admin)</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-medium">Transaction & order data</h3>
                            <ul class="mt-2 list-disc pl-5 text-gray-700">
                                <li>Orders, invoices, refunds, subscription status</li>
                                <li>Payment method tokens/IDs via payment processors (we don’t store full card data)</li>
                                <li>Delivery preferences and history</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-medium">Usage & device</h3>
                            <ul class="mt-2 list-disc pl-5 text-gray-700">
                                <li>IP address, device info, app version, language</li>
                                <li>Log data, crash reports, diagnostics, performance</li>
                                <li>Approximate location derived from IP (where permitted)</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="font-medium">Support & communications</h3>
                            <ul class="mt-2 list-disc pl-5 text-gray-700">
                                <li>Support requests, emails, chat messages</li>
                                <li>Survey responses, feedback, ratings, reviews</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div id="how-we-use" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">2) How we use your data</h2>
                    <ul class="mt-4 list-disc pl-5 text-gray-700 space-y-2">
                        <li>Provide and operate the Platform (accounts, orders, course access, progress tracking).</li>
                        <li>Personalize content, recommendations, and search results.</li>
                        <li>Process payments, prevent fraud, handle disputes and refunds.</li>
                        <li>Deliver customer support and service communications.</li>
                        <li>Send important updates (policy changes, security notices).</li>
                        <li>Improve features, security, and performance; perform analytics.</li>
                        <li>Comply with legal obligations and enforce terms.</li>
                        <li>With consent, send marketing emails/notifications (you can opt out anytime).</li>
                    </ul>
                </div>

                <div id="legal-bases" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">3) Legal bases</h2>
                    <p class="mt-2 text-gray-700">
                        Where applicable (e.g., EEA/UK), we rely on: (a) performance of a contract; (b) legitimate interests
                        (e.g., to secure and improve the Platform); (c) compliance with legal obligations; and (d) your consent
                        (e.g., for certain cookies/marketing).
                    </p>
                </div>

                <div id="cookies" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">4) Cookies & tracking</h2>
                    <p class="mt-2 text-gray-700">
                        We use cookies and similar technologies for essential functionality, preferences, analytics, and (where applicable)
                        advertising. You can manage preferences in your browser and via our cookie banner (if available).
                    </p>
                    <ul class="mt-3 list-disc pl-5 text-gray-700">
                        <li><span class="font-medium">Necessary:</span> login/session, security, load balancing.</li>
                        <li><span class="font-medium">Functional:</span> preferences like language and saved carts.</li>
                        <li><span class="font-medium">Analytics:</span> usage statistics to improve services.</li>
                        <li><span class="font-medium">Advertising (optional):</span> personalized ads where permitted by law and consented.</li>
                    </ul>
                </div>

                <div id="payments" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">5) Payments</h2>
                    <p class="mt-2 text-gray-700">
                        Payments are processed by third-party processors (e.g., card networks, UPI, wallets). We receive limited payment metadata
                        (e.g., token/transaction IDs) and do not store full card numbers. Your use of a payment method is subject to the processor’s policy.
                    </p>
                </div>

                <div id="elearning" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">6) E-learning data</h2>
                    <ul class="mt-2 list-disc pl-5 text-gray-700 space-y-2">
                        <li>Course enrollments, completions, certificates, grades (if used), quiz/exam results.</li>
                        <li>Learning behavior signals (e.g., time spent, progress, attempts) to improve learning outcomes.</li>
                        <li>Instructor materials (videos, PDFs, assignments), and communications with learners.</li>
                        <li>Proctoring/anti-cheating tools may process camera/microphone or screen data if you opt into proctored exams (you’ll see a clear prompt and can deny where applicable).</li>
                    </ul>
                </div>

                <div id="ugc" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">7) User content & communities</h2>
                    <p class="mt-2 text-gray-700">
                        If you post content (reviews, forum posts, messages), it may be publicly visible or visible to your class/group as per settings.
                        Please avoid sharing sensitive personal data in public areas.
                    </p>
                </div>

                <div id="sharing" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">8) Sharing & processors</h2>
                    <p class="mt-2 text-gray-700">We may share data with:</p>
                    <ul class="mt-2 list-disc pl-5 text-gray-700 space-y-2">
                        <li><span class="font-medium">Service providers/processors:</span> hosting, analytics, support, email/SMS, payments, content delivery, proctoring.</li>
                        <li><span class="font-medium">Business partners:</span> delivery partners, vendors/merchants, instructors (only as needed).</li>
                        <li><span class="font-medium">Legal & compliance:</span> when required by law or to protect rights, safety, and security.</li>
                        <li><span class="font-medium">Corporate events:</span> merger, acquisition, or asset sale (with safeguards).</li>
                    </ul>
                    <p class="mt-3 text-gray-700">
                        We require processors to protect your data and use it only under our instructions.
                    </p>
                </div>

                <div id="intl" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">9) International transfers</h2>
                    <p class="mt-2 text-gray-700">
                        Your information may be transferred to and processed in countries other than your own. Where required,
                        we implement appropriate safeguards (e.g., standard contractual clauses) and limit access on a need-to-know basis.
                    </p>
                </div>

                <div id="retention" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">10) Data retention</h2>
                    <p class="mt-2 text-gray-700">
                        We retain personal data only as long as necessary for the purposes described above, to comply with legal obligations,
                        resolve disputes, and enforce agreements. Retention periods vary by data type and context (e.g., tax/financial records).
                    </p>
                </div>

                <div id="security" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">11) Security</h2>
                    <p class="mt-2 text-gray-700">
                        We use technical and organizational measures (encryption in transit, access controls, monitoring, backups)
                        to protect data. No system is 100% secure; please use a strong, unique password and keep it confidential.
                    </p>
                </div>

                <div id="rights" class="rounded-xl border bg-white p-6 space-y-6">
                    <h2 class="text-xl font-semibold">12) Your rights</h2>

                    <div>
                        <h3 class="font-medium">General requests</h3>
                        <p class="mt-2 text-gray-700">
                            You may request access, correction, deletion, restriction, or portability of certain personal data, or object to processing.
                            For requests, contact us at <a href="mailto:{{ $contactMail }}" class="text-blue-600 hover:underline">{{ $contactMail }}</a>.
                            We may need to verify your identity before acting on a request.
                        </p>
                    </div>

                    <div>
                        <h3 class="font-medium">GDPR/UK GDPR (EEA/UK)</h3>
                        <ul class="mt-2 list-disc pl-5 text-gray-700">
                            <li>Rights include access, rectification, erasure, restriction, portability, and objection.</li>
                            <li>Where we rely on consent, you can withdraw it at any time.</li>
                            <li>You may lodge a complaint with your supervisory authority.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-medium">CCPA/CPRA (California)</h3>
                        <ul class="mt-2 list-disc pl-5 text-gray-700">
                            <li>Rights to know, delete, correct, and opt-out of “sale”/“sharing” of personal information (as defined by law).</li>
                            <li>We do not discriminate for exercising privacy rights.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-medium">India DPDP Act, 2023</h3>
                        <ul class="mt-2 list-disc pl-5 text-gray-700">
                            <li>Rights to access information about processing, correction and erasure, grievance redressal, and nomination.</li>
                            <li>Where consent is the basis, you may withdraw consent (processing up to withdrawal remains lawful).</li>
                        </ul>
                        <p class="mt-2 text-gray-700">
                            You may raise grievances with our Grievance Officer (see contact below).
                        </p>
                    </div>
                </div>

                <div id="children" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">13) Children’s privacy</h2>
                    <p class="mt-2 text-gray-700">
                        Our Platform is not intended for children under the age required by applicable law without parental/guardian consent.
                        If we learn we have collected personal data from a child without required consent, we will take steps to delete it.
                    </p>
                </div>

                <div id="changes" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">14) Changes to this policy</h2>
                    <p class="mt-2 text-gray-700">
                        We may update this policy from time to time. We will post the updated version with a new “Last updated” date.
                        Significant changes may be notified via email or in-app notice.
                    </p>
                </div>

                <div id="contact" class="rounded-xl border bg-white p-6">
                    <h2 class="text-xl font-semibold">15) Contact us</h2>
                    <div class="mt-2 text-gray-700 space-y-2">
                        <p><span class="font-medium">Controller/Operator:</span> {{ $entity }}</p>
                        <p><span class="font-medium">Address:</span> {{ $address }} ({{ $country }})</p>
                        <p><span class="font-medium">Email:</span> <a class="text-blue-600 hover:underline" href="mailto:{{ $contactMail }}">{{ $contactMail }}</a></p>
                        @if($dpoMail)
                            <p><span class="font-medium">Data Protection Officer / Grievance Officer (India):</span>
                               <a class="text-blue-600 hover:underline" href="mailto:{{ $dpoMail }}">{{ $dpoMail }}</a></p>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="border-t bg-white">
        <div class="mx-auto max-w-6xl px-4 py-8 text-sm text-gray-600">
            © {{ now()->year }} {{ $company }}. All rights reserved.
        </div>
    </footer>
</body>
</html>
