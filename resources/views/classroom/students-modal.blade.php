<div class="modal fade" tabindex="-1" id="showStudents">
    <div class="modal-dialog modal-lg" role="file">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Students</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">First Grading</th>
                                <th scope="col">Second Grading</th>
                                <th scope="col">Third Grading</th>
                                <th scope="col">Fourth Grading</th>
                                <th scope="col">Prediction </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($classroom->students as $student)

                                @php
                                    $studentGrade = null;

                                    foreach($classroom->studentGrades as $grade){
                                        if($grade->student_id == $student->id){
                                            $studentGrade = $grade;
                                            break;
                                        }
                                    }
                                    $prediction = 0;
                                    $chosen = [-3, 3];

                                    $chosen = $chosen[array_rand($chosen)];

                                    if ($studentGrade->quarter_1 != null) {
                                        if($studentGrade->quarter_2 == null && $studentGrade->quarter_3 == null && $studentGrade->quarter_4 == null)
                                            $prediction += $studentGrade->quarter_1 + $chosen;
                                        else if($studentGrade->quarter_3 == null && $studentGrade->quarter_4 == null)
                                            $prediction += ($studentGrade->quarter_1 + $studentGrade->quarter_2) / 2;
                                        else if($studentGrade->quarter_4 == null)
                                            $prediction += ($studentGrade->quarter_1 + $studentGrade->quarter_2 + $studentGrade->quarter_3) / 3 ;
                                        else
                                            $prediction += ($studentGrade->quarter_1 + $studentGrade->quarter_2 + $studentGrade->quarter_3 + $studentGrade->quarter_4) / 4 ;

                                    }
                                        // $prediction += $chosen;



                                @endphp



                                <tr>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $studentGrade->quarter_1 ? $studentGrade->quarter_1 : "N/A" }}</td>
                                    <td>

                                        {{ $studentGrade->quarter_2 ? $studentGrade->quarter_2 : "N/A" }}

                                    </td>
                                    <td>{{ $studentGrade->quarter_3 ? $studentGrade->quarter_3 : "N/A" }}</td>
                                    <td>{{ $studentGrade->quarter_4 ? $studentGrade->quarter_4 : "N/A" }}</td>
                                    <td>{{ $prediction }}</td>

                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Students</span>
            </div>
        </div>
    </div>
</div>
